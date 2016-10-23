<?php

namespace Papi\Middleware;

use Slim\Http\Response;
use Slim\Http\Request;
use Slim\Container;

/**
 * Papi\Middleware\ExampleIn
 * Example middleware that checks route for something and returns a 401 or continues to next middleware item if one available
 * Middleware is great for altering, adding, removing, checking, converting, incoming and outgoing requests
 */
final class ExampleIn
{
    /** @var Slim\Container slims DI container */
    private $container;

    public function __construct(Container $container)
    {
		// use the container to get any injected deps and use in your middleware
        $this->container = $container;
    }

	public function __invoke(Request $request, Response $response, callable $next)
    {
		// get incomming route
        $route = $request->getAttribute('route');

		// do something with route, maybe check an argument!
		if (!$route) return $response->withStatus(401);

		// move on to next middleware
        return $next($request, $response);
    }
}
