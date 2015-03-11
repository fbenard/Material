<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

abstract class AbstractQuery
{
	// Traits

	use \fbenard\Zero\Traits\Get;

	
	// Attributes

	protected $_connection = null;
	protected $_type = null;


	/**
	 *
	 */

	public function __construct()
	{
		// Build the class name

		$className = get_class($this);
		$className = explode('\\', $className);
		$className = array_pop($className);

		
		// Build the query type
		
		$queryType = str_replace('Query', null, $className);
		$queryType = strtolower($queryType);


		// Store the query type

		$this->_type = $queryType;


		// Build the connection

		$this->_connection = \z\service('manager/connection')->getConnection();
	}


	/**
	 *
	 */

	public function execute()
	{
		// Build the transformer

		$queryTransformer = \z\service('transformer/' . $this->_connection->system . '/query/' . $this->_type);


		// Transform the query

		$query = $queryTransformer->transform($this, $this->_connection);


		// Execute the query

		$result = $this->_connection->driver->executeQuery($query);


		return $result;
	}
}

?>
