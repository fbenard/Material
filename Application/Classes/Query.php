<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

class Query
{
	// Attributes

	private $_table = null;
	private $_type = null;


	/**
	 *
	 */

	public function create($tableCode, $callback)
	{
		// Connect to a connection

		// Build the table

		$table = new \fbenard\Material\Classes\Table($tableCode);
		$callback($table);


		//

		$this->_table = $table;
		$this->_type = __FUNCTION__;


		// Execute the query

		$this->execute();


		return $table;
	}


	/**
	 *
	 */

	public function delete($tableCode)
	{
		// Build the table

		$table = new \fbenard\Material\Classes\Table($tableCode);


		//

		$this->_table = $table;
		$this->_type = __FUNCTION__;


		// Execute the query

		$this->execute();


		return $table;
	}


	/**
	 *
	 */

	public function execute()
	{
		$rawQuery = $this->transform();
		print_r($rawQuery);
	}


	/**
	 *
	 */

	public function getType()
	{
		return $this->_type;
	}


	/**
	 *
	 */

	public function getTable()
	{
		return $this->_table;
	}


	/*
	public function reconnect($connectionCode)
	public function disconnect($connectionCode)
	public function connection($connectionCode)
	DB::listen(function($sql, $bindings, $time)
	DB::transaction(function()
	DB::beginTransaction();
	DB::rollback();
	DB::commit();
	*/
}

?>
