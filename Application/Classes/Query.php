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

	public function __get($attributeCode)
	{
		$attributeCode = '_' . $attributeCode;
		return $this->$attributeCode;
	}


	/**
	 *
	 */

	public function create($tableCode, $callbacks)
	{
		// Connect to a connection

		// Build the table

		$table = new \fbenard\Material\Classes\Table($tableCode);
		

		// Apply each callback

		foreach ($callbacks as $callback)
		{
			$callback($table);
		}


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
		//

		$connection = new \fbenard\Material\Classes\Connection();
		$connection->driver->executeQuery($this);
	}


	/*
	DB::listen(function($sql, $bindings, $time)
	DB::transaction(function()
	DB::beginTransaction();
	DB::rollback();
	DB::commit();
	*/
}

?>
