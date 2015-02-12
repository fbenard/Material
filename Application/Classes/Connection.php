<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

class Connection
{
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
		//

		$connections = \z\pref('splio/goloboard/db/connections');

		if (is_array($connections) === false)
		{
			$connections = [];
		}

		
		//

		if (empty($connectionCode) === true)
		{
			$connection = array_shift($connections);
		}
		else if (array_key_exists($connectionCode, $connections) === true)
		{
			$connection = $connections[$connectionCode];
		}


		//

		if (empty($connection) === true)
		{
			\z\e();
		}


		//

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


		//

		$this->_host = $connection['host'];
		$this->_login = $connection['login'];
		$this->_password = $connection['password'];
		$this->_name = $connection['name'];


		//

		$className = '\\fbenard\\Material\\Services\\Drivers\\' . $connection['driver'] . 'Driver';
		
		$this->_driver = new $className();


		//

		$this->_driver->connect($this);
	}


	/**
	 *
	 */

	public function __get($attributeCode)
	{
		$attributeCode = '_' . $attributeCode;
		return $this->$attributeCode;
	}
}

?>
