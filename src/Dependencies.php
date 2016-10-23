<?php

use Slim\Container;
use Papi\Services\Example;

/**
 * Dependencies
 * Load all system dependencies from a single location using slims DI container
 */

// Papi\Services\Example
$this->container['Example'] = function (Container $container) {
	return new Example($container);
};
