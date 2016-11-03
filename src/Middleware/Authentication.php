<?php

namespace Papi\Middleware;

use Slim\Http\Response;
use Slim\Http\Request;
use Slim\Container;

/**
 * Papi\Middleware\Authentication
 * Authentication middleware: Checks user authentication to access the resource using access args on routes
 */
final class Authentication
{
    /** @var Slim\Container slims DI container */
    private $container;
	/** @var Papi\Services\Authentication for handling session based authentication */
	private $auth;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->auth = $container->get("AuthenticationService");
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
        $uri = $request->getUri();
        $path = $uri->getPath();

		// permanently redirect trailing slashes
        if ($path != '/' && substr($path, -1) == '/') {
            $uri = $uri->withPath(substr($path, 0, -1));
            return $response->withRedirect((string) $uri, 301);
        }

		// do we have access for route
        if ($request->getAttribute('route')) {
            $access = $request->getAttribute('route')->getArgument('access');
			$access = empty($access) ? 'restricted' : strtolower($access);

			// only allow access to public routes if not logged in
			if ($access == 'public' || $this->auth->isLoggedIn()) return $next($request, $response);

			// no access
			return $response->withStatus(401)->withJson(['status' => 'fail', 'message' => 'You do not have permission to access this resource']);
		}

		// route not found
		return $response->withStatus(404)->withJson(['status' => 'fail', 'message' => 'Could not find the resource you where looking for']);
    }
}
