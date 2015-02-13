<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

class Query
{
	// Traits

	use \fbenard\Zero\Traits\Get;

	
	// Attributes

	private $_table = null;
	private $_type = null;


	/**
	 *
	 */

	public function createTable($tableCode, $callbacks)
	{
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
