<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class CreateQueryTransformer
extends \fbenard\Material\Classes\AbstractQueryTransformer
{
	/**
	 *
	 */

	public function transform($query, $connector)
	{
		// Prepare the result

		$result =
		[
			'CREATE',
			'TABLE',
			\z\service('transformer/mysql/query/create/table')->transform($query->table, $connector),
			$this->transformEngine($query, $connector),
			$this->transformCharset($query, $connector)
		];
		

		// Build the result
		
		$result = $this->buildResult($result);


		return $result;
	}


	/**
	 *
	 */

	private function transformCharset($query, $connection)
	{
		// Prepare the result

		$result = [];


		// Add the charset

		$charset = $query->charset;

		if (empty($charset) === false)
		{		
			$result[] = 'DEFAULT CHARSET=' . $charset;
		}
		

		// Build the result
		
		$result = $this->buildResult($result);


		return $result;
	}


	/**
	 *
	 */

	private function transformEngine($query, $connection)
	{
		// Prepare the result

		$result = [];


		// Add the engine

		$engine = $query->engine;

		if (empty($engine) === false)
		{		
			$result[] = 'ENGINE=' . $engine;
		}
		

		// Build the result
		
		$result = $this->buildResult($result);


		return $result;
	}
}

?>
