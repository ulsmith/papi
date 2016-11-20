<?php

use Slim\Container;

use Papi\Middleware\Cors as CorsMiddleware;
use Papi\Middleware\Authentication as AuthenticationMiddleware;

use Papi\Services\Session as SessionService;
use Papi\Services\Authentication as AuthenticationService;
use Papi\Services\Example as ExampleService;

/**
 * Dependencies
 * Load all system dependencies from a single location using slims DI container
 */

// Papi\Middleware\Cors
$this->container["CorsMiddleware"] = function (Container $container) {
	return new CorsMiddleware($container);
};

// Papi\Middleware\Authentication
$this->container["AuthenticationMiddleware"] = function (Container $container) {
	return new AuthenticationMiddleware($container);
};

// Papi\Services\Session
$this->container['SessionService'] = function (Container $container) {
	return new SessionService($container);
};

// Papi\Services\Authentication
$this->container['AuthenticationService'] = function (Container $container) {
   return new AuthenticationService($container);
};

// Papi\Services\Example
$this->container['ExampleService'] = function (Container $container) {
	return new ExampleService($container);
};
