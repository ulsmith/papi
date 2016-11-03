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
	/** @var Papi\Services\AuthenticationService authentication */
	private $auth;
    /** @var Example sample example service injected */
    private $example;

    public function __construct(Container $container)
    {
        $this->container = $container;
		$this->auth = $container->get('AuthenticationService');
		$this->example = $container->get('ExampleService');
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
		$data = [
			'status' => 'success',
			'message' => 'you hit the index page... service test:'.$this->example->test().' if logged in you will see user deails, to login POST request to /account/login with JSON user=test password=test, to logout GET to /account/logout',
		];

		if ($this->auth->isLoggedIn()) $data['data'] = $this->auth->getLoggedIn();

		return $response->withJson($data);
    }
}
