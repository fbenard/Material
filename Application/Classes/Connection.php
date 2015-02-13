<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

class Connection
{
	// Traits

	use \fbenard\Zero\Traits\Get;

	
	// Attributes

	private $_driver = null;
	private $_host = null;
	private $_login = null;
	private $_name = null;
	private $_password = null;


	/**
	 *
	 */

	public function __construct($connectionCode = null)
	{
		// Grab connections

		$connections = \z\pref('splio/goloboard/db/connections');

		if (is_array($connections) === false)
		{
			$connections = [];
		}

		
		// Get a connection

		if (empty($connectionCode) === true)
		{
			$connection = array_shift($connections);
		}
		else if (array_key_exists($connectionCode, $connections) === true)
		{
			$connection = $connections[$connectionCode];
		}


		// Check whether there's a connection

		if (empty($connection) === true)
		{
			\z\e
			(
				'EXCEPTION_DB_CONNECTION_NOT_FOUND',
				[
					'connectionCode' => $connectionCode,
					'connections' => $connections
				]
			);
		}


		// Make sure connection has the expected structure

		$connection = array_merge
		(
			[
				'driver' => null,
				'host' => null,
				'login' => null,
				'password' => null,
				'name' => null
			],
			$connection
		);


		// Store credentials

		$this->_host = $connection['host'];
		$this->_login = $connection['login'];
		$this->_password = $connection['password'];
		$this->_name = $connection['name'];


		// Build the driver

		$className = '\\fbenard\\Material\\Services\\Drivers\\' . $connection['driver'] . 'Driver';
		
		$this->_driver = new $className();


		// Connect the driver

		$this->_driver->connect($this);
	}
}

?>
