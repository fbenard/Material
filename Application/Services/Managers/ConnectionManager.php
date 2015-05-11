<?php

// Namespace

namespace fbenard\Material\Services\Managers;


/**
 *
 */

class ConnectionManager
{
	// Traits

	use \fbenard\Zero\Traits\GetTrait;

	
	// Attributes

	private $_connections = null;


	/**
	 *
	 */

	public function __construct()
	{
		$this->_connections = [];
	}


	/**
	 *
	 */

	public function getConnection($connectionCode = null)
	{
		// Grab definitions

		$definitions = \z\pref('fbenard/material/db/connections');

		if (is_array($definitions) === false)
		{
			$definitions = [];
		}

		
		// Define the connection code

		if (empty($connectionCode) === true)
		{
			$definitions = array_splice($definitions, 0, 1);
			$keys = array_keys($definitions);
			$connectionCode = array_shift($keys);
		}


		// Get the definition

		if (array_key_exists($connectionCode, $definitions) === true)
		{
			$definition = $definitions[$connectionCode];
		}


		// Check whether there's a definition

		if (empty($definition) === true)
		{
			\z\e
			(
				EXCEPTION_DB_CONNECTION_NOT_FOUND,
				[
					'connectionCode' => $connectionCode,
					'definitions' => $definitions
				]
			);
		}


		// Has the connection been retrieved already?

		if (array_key_exists($connectionCode, $this->_connections) === false)
		{
			// Build the connection

			$connection = \z\service('factory/connection')->buildConnection($definition);


			// Connect the driver

			$connection->driver->connect($connection);


			// Store the connection

			$this->_connections[$connectionCode] = $connection;
		}


		// Get the connection

		$connection = $this->_connections[$connectionCode];


		return $connection;
	}
}

?>
