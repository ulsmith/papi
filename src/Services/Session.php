<?php

namespace Papi\Services;

use Papi\Library\SecureSessionHandler;

/**
 * Session Helper
 * Creates session as a service, sets some basics, adds encrytion by default via SecureSessionHandler even if you dont want it.
 * Allows you to use sessions securely via the means set out in php.ini (files, redis etc).
 * Gives simple access to session data in a secure way using dot notation via get(), set(), delete()...
 */
class Session
{
    public function __construct()
    {
        // server/client should keep session data for 1 day, also set secure handler by default
        ini_set('session.gc_maxlifetime', SESSION_LIFETIME);
		session_set_cookie_params(SESSION_LIFETIME);
		session_set_save_handler(new SecureSessionHandler(SESSION_KEY), true); // 48 chars max
    }

	/**
	 * start()
	 * Start a secure session
	 */
    public function start()
    {
		return session_start();
    }

	/**
	 * destroy()
	 * Destroy a secure session
	 */
    public function destroy()
    {
        return session_destroy();
    }

	/**
	 * regenerate()
	 * Regenerate a secure session ID
	 */
    public function regenerate()
    {
		return session_regenerate_id(true);
    }

	/**
	 * get($key)
	 * Get a session value based on it's key in dot notation
	 * @param string $key The key/name of the value to retrieve such as 'foo.bar.baz'
	 * @return mixed The value found in session or false on fail
	 */
	public function get($key = null)
	{
		if (!$key) return $_SESSION;
		if (empty($_SESSION)) return false;

		$temp = $_SESSION;

		$parts = explode('.', $key);
		while (count($parts)) {
			$part = array_shift($parts);
			if (!isset($temp[$part])) return false;
			$temp = $temp[$part];
		}
		return $temp;
	}

	/**
	 * set($key, $value)
	 * Set a session value based on key in dot notation and value
	 * @param string $key The key/name of the value to set such as 'foo.bar.baz'
	 * @param mixed $value The value to set
	 * @return boolean false on fail true on success
	 */
	public function set($key, $value)
	{
		if (!$key) return false;

		$temp =& $_SESSION;
		$parts = explode('.', $key);
		while (count($parts) > 1) {
			$part = array_shift($parts);
			if (!isset($temp[$part]) || !is_array($temp[$part])) $temp[$part] = [];
			$temp =& $temp[$part];
		}
		$temp[array_shift($parts)] = $value;

		return true;
	}

	/**
	 * delete($key)
	 * Delete a session value based on it's key in dot notation
	 * @param string $key The key/name of the value to delete such as 'foo.bar.baz'
	 * @return boolean false on fail true on success
	 */
	public function delete($key)
	{
		if (!$key) return false;

		$temp =& $_SESSION;
		$parts = explode('.', $key);
		while (count($parts) > 1) {
			$part = array_shift($parts);
			if (!isset($temp[$part]) || !is_array($temp[$part])) $temp[$part] = [];
			$temp =& $temp[$part];
		}
		unset($temp[array_shift($parts)]);

		return true;
	}
}
