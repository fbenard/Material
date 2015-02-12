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

		$queryTransformer = new \fbenard\Material\Services\Transformers\MySql\QueryTransformer();
		$rawQuery = $queryTransformer->transform($this);
		\z\dlog($rawQuery);


		//

		$connection = new \fbenard\Material\Classes\Connection();

		
		//

		$databaseDriver = new \fbenard\Material\Services\Drivers\MySqlDriver();
		$databaseDriver->connect($connection);
		$databaseDriver->executeQuery($rawQuery);
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
