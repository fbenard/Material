<?php

// Namespace

namespace fbenard\Material\Services\Drivers;


/**
 *
 */

class MySqlDriver
{
	// Traits

	use \fbenard\Zero\Traits\Get;

	
	// Attributes

	private $_connection = null;
	private $_handle = null;


	/**
	 *
	 */

	public function connect($connection)
	{
		//

		$this->_connection = $connection;


		//

		$this->_handle = new \mysqli
		(
			$this->_connection->host,
			$this->_connection->login,
			$this->_connection->password,
			$this->_connection->name
		);


		//

		if ($this->_handle->connect_error)
		{
			\z\e
			(
				'EXCEPTION_DB_CONNECT_FAILED',
				[
					'error' => $this->_handle->connect_error,
					'connection' => $connection
				]
			);
		}
	}


	/**
	 *
	 */

	public function disconnect()
	{
	}


	/**
	 *
	 */

	public function getAffectedRows()
	{
		//

		$result = $this->_handle->affected_rows;


		return $result;
	}


	/**
	 *
	 */

	public function getLastId()
	{
		//

		$result = $this->_handle->insert_id;


		return $result;
	}


	/**
	 *
	 */

	public function executeQuery($query)
	{
		//

		$queryResult = $this->_handle->query($query);

		
		//

		if ($queryResult === false)
		{
			\z\e
			(
				'EXCEPTION_DB_QUERY_FAILED',
				[
					'error' => $this->_handle->error,
					'query' => $query
				]
			);
		}


		//

		if (is_object($queryResult) === true)
		{
			return $queryResult->fetch_all(MYSQLI_ASSOC);
		}
	}
}

?>
