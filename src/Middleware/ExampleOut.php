<?php

namespace Papi\Middleware;

use Slim\Http\Response;
use Slim\Http\Request;
use Slim\Container;

/**
 * Papi\Middleware\ExampleOut
 * Example middleware that adds a header to all outgoing requests
 * Middleware is great for altering, adding, removing, checking, converting, incoming and outgoing requests
 */
final class ExampleOut
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
		$response = $next($request, $response);

		// Add a header to all outgoing requests
		return $response->withHeader('Example-Header', 'something');
    }
}
