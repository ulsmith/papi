<?php

namespace Papi\Services;

use Slim\Container;

/**
 * Papi\Session\Authentication
 * Authentication service to handle middleware checks for auth as well as performing login and logout actions
 */
class Authentication
{
    /** @var Slim\Container slims DI container */
    private $container;
	/** @var Papi\Services\AuthenticationService authentication */
	private $session;

    public function __construct(Container $container)
    {
        $this->container = $container;
		$this->session = $container->get('SessionService');
    }

	public function login($user, $pass)
	{
		// BEWARE - EXAMPLE ONLY!!!
		// VERY BASIC AUTH
		// Uses session to track users, also checks cookie key for bit extra security
		// Recommend swithcing to DB of some kind ofr user, log timestamps, user agent, and maybe generate web token better than below

		if ($user == 'test' && $pass == 'test') {
			$key = sha1($user.time().strlen($pass));

			$this->session->set('user', ['user' => 'test', 'name' => 'Test Testerer', 'access' => 1, 'key' => $key]);
			setcookie("key", $key, time() + 43200, '/');

			return true;
		}

		$this->logout();
		return false;
	}

	public function logout()
	{
		setcookie("key", "expire", time() - 1);
		$this->session->destroy();
	}

	public function isLoggedIn()
	{
		// BEWARE - EXAMPLE ONLY!!!
		// VERY BASIC AUTH
		// Uses session to track users, also checks cookie key for bit extra security
		// Recommend also verifying more things like web token, last logged, user agent etc etc...

		return $this->session->get('user') && $this->session->get('user.key') == $_COOKIE['key'];
	}

	public function getLoggedIn()
	{
		return $this->isLoggedIn() ? $this->session->get('user') : false;
	}
}
