<?php

namespace Papi\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;

/**
 * Papi\Controllers\Index
 * Default controller
 */
class Index
{
    /** @var Slim\Container slims DI container */
    private $container;
    /** @var Example sample example service injected */
    private $example;

    public function __construct(Container $container)
    {
        $this->container = $container;
		$this->example = $container->get('Example');
    }

	/**
	 * index()
	 * Default method for default controller
	 * @param Request $request The PSR-7 message request coming into slim
	 * @param Response $response The PSR-7 message response going out of slim
	 * @param array $args Any arguments passed in from request
	 */
    public function index(Request $request, Response $response, $args)
    {
		return $response->withJson(['status' => 'success', 'data' => 'some data...']);
    }
}
