<?php

namespace Papi\Middleware;

use Slim\Http\Response;
use Slim\Http\Request;
use Slim\Container;

/**
 * CORS Middleware to check a domain header against a whiltelist from environment vars, if present respond with correct headers.
 */
final class Cors
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
		$response = $next($request, $response);

		// Basic checks that referer matches whitelist, maybe do some more on this
		if (!empty($_SERVER['HTTP_ORIGIN']) && !empty($_SERVER["HTTP_HOST"]))
		{
			$domains = explode(',', str_replace(' ', '', getenv('CORS_WHITELIST')));
			$parsedUrl = parse_url($_SERVER["HTTP_ORIGIN"]);
			$origin = "{$parsedUrl['scheme']}://{$parsedUrl['host']}".(!empty($parsedUrl['port']) ? ":{$parsedUrl['port']}" : '');

			if (in_array($origin, $domains))
			{
				return $response->withHeader('Access-Control-Allow-Origin', $origin)
					->withHeader('Access-Control-Allow-Credentials', 'true')
					->withHeader('Access-Control-Allow-Headers', 'Content-Type, content-type, application/json')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
					->withHeader('P3P', 'CP="ALL IND DSP COR ADM CONo CUR CUSo IVAo IVDo PSA PSD TAI TELo OUR SAMo CNT COM INT NAV ONL PHY PRE PUR UNI"');
			}
		}

		return $response;
	}
}
