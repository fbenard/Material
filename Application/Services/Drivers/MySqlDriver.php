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
		// Store the connection

		$this->_connection = $connection;


		// Create the handle

		$this->_handle = new \mysqli
		(
			$this->_connection->host,
			$this->_connection->login,
			$this->_connection->password,
			$this->_connection->name
		);

		
		// Check whether creation worked

		if ($this->_handle->connect_error)
		{
			\z\e
			(
				EXCEPTION_DB_CONNECTION_FAILED,
				[
					'error' => $this->_handle->connect_error,
					'connection' => $connection
				]
			);
		}


		// Setup the handle

		$this->_handle->options(MYSQLI_OPT_LOCAL_INFILE, true);
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
		// Get affected rows

		$result = $this->_handle->affected_rows;


		return $result;
	}


	/**
	 *
	 */

	public function getLastId()
	{
		// Get the last ID

		$result = $this->_handle->insert_id;


		return $result;
	}


	/**
	 *
	 */

	public function executeQuery($query)
	{
		// Execute the query

		$queryResult = $this->_handle->query($query);

		
		// Check whether the query worked

		if ($queryResult === false)
		{
			\z\e
			(
				EXCEPTION_DB_QUERY_FAILED,
				[
					'error' => $this->_handle->error,
					'query' => $query
				]
			);
		}


		// Fetch all results, if any

		if (is_object($queryResult) === true)
		{
			return $queryResult->fetch_all(MYSQLI_ASSOC);
		}
	}
}

?>
