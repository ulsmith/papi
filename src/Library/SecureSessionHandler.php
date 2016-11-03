<?php
namespace Papi\Library;

/**
 * Secure Session Handler
 * Enable secure session handling
 */
class SecureSessionHandler extends \SessionHandler
{
	private $key = '';

	public function __construct($key)
	{
		$this->key = hash('sha256', $key, true);
	}

	/**
	 * read($id)
	 * Extend session handlers default read to decrypt data
	 */
	public function read($id)
	{
	    return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, parent::read($id), MCRYPT_MODE_ECB);
	}

	/**
	 * write($id, $data)
	 * Extend session handlers default write to encrypt data
	 */
	public function write($id, $data)
	{
	    return parent::write($id, mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $data, MCRYPT_MODE_ECB));
	}
}
