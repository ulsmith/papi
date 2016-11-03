<?php

namespace Papi\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;

/**
 * Papi\Controllers\Index
 * Default controller
 */
class Account
{
    /** @var Slim\Container slims DI container */
	private $container;
	/** @var Papi\Services\Authentication for handling session based authentication */
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
	 * login()
	 * Default method for default controller
	 * @param Request $request The PSR-7 message request coming into slim
	 * @param Response $response The PSR-7 message response going out of slim
	 * @param array $args Any arguments passed in from request
	 */
    public function login(Request $request, Response $response, $args)
    {
		// already logged in?
		if ($this->auth->isLoggedIn()) {
			return $response->withJson(['status' => 'success', 'message' => 'You are already logged in, visit the home page for user details...']);
		}

		// get details
		$user = $request->getParsedBodyParam('user');
		$pass = $request->getParsedBodyParam('password');

		// log in user
		if ($this->auth->login($user, $pass)) {
			return $response->withJson(['status' => 'success', 'message' => 'You are now logged in, visit the home page for user details...']);
		}

		return $response->withJson(['status' => 'success', 'message' => 'You need to login, POST to this address with JSON user="test" password="test"']);
    }

	/**
	 * logout()
	 * Default method for default controller
	 * @param Request $request The PSR-7 message request coming into slim
	 * @param Response $response The PSR-7 message response going out of slim
	 * @param array $args Any arguments passed in from request
	 */
    public function logout(Request $request, Response $response, $args)
    {
		$this->auth->logout();

		return $response->withJson(['status' => 'success', 'message' => 'You are now logged out, visit the home to see user details not present...']);
    }
}
