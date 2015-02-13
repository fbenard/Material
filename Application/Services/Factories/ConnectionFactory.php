<?php

// Namespace

namespace fbenard\Material\Services\Factories;


/**
 *
 */

class ConnectionFactory
{
	/**
	 *
	 */

	public function buildConnection($definition)
	{
		// Fix the definition

		$definition = $this->fixDefinition($definition);


		// Build a connection

		$connection = new \fbenard\Material\Classes\Connection();


		// Store the definition

		$connection->host = $definition['host'];
		$connection->login = $definition['login'];
		$connection->password = $definition['password'];
		$connection->name = $definition['name'];
		$connection->system = $definition['system'];


		// Build the driver

		$connection->driver = \z\service('driver/db/' . $connection->system, true);


		return $connection;		
	}


	/**
	 *
	 */

	public function fixDefinition($definition)
	{
		// Make sure definition has the expected structure

		$definition = array_merge
		(
			[
				'host' => null,
				'login' => null,
				'name' => null,
				'password' => null,
				'system' => null
			],
			$definition
		);


		return $definition;
	}
}

?>
