<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class CreateTableTransformer
extends \fbenard\Material\Classes\AbstractQueryTransformer
{
	/**
	 *
	 */

	public function transform($table, $connection)
	{
		// Prepare the result

		$result =
		[
			'`' . $table->code . '`',
			'(',
			$this->transformInstructions($table, $connection),
			')'
		];
		

		// Build the result
		
		$result = $this->buildResult($result);


		return $result;
	}


	/**
	 *
	 */

	private function transformFields($table, $connection)
	{
		//

		$result = [];

		foreach ($table->fields as $field)
		{
			$result[] = \z\service('transformer/mysql/query/create/field')->transform($field, $connection);
		}


		return $result;
	}


	/**
	 *
	 */

	private function transformInstructions($table, $connection)
	{
		// Prepare the result

		$result = array_merge
		(
			$this->transformFields($table, $connection),
			$this->transformPrimaryKey($table, $connection),
			$this->transformUniqueKeys($table, $connection)
		);


		// Build the result
		
		$result = $this->buildResult($result, ', ');


		return $result;
	}


	/**
	 *
	 */

	private function transformPrimaryKey($table, $connection)
	{
		// Prepare the result

		$result = [];


		//

		$primaryKey = $table->primaryKey;

		if (is_array($primaryKey) === false)
		{
			$primaryKey = [];
		}


		//

		foreach ($primaryKey as &$fieldCode)
		{
			$fieldCode = '`' . $fieldCode . '`';
		}


		//

		if (empty($primaryKey) === false)
		{
			$result[] = 'PRIMARY KEY (' . implode(', ', $primaryKey) . ')';
		}


		return $result;
	}


	/**
	 *
	 */

	private function transformUniqueKeys($table, $connection)
	{
		//

		$result = [];

		foreach ($table->uniqueKeys as $keyCode => $key)
		{
			//

			foreach ($key as &$fieldCode)
			{
				$fieldCode = '`' . $fieldCode . '`';
			}

			
			//
			
			$result[] = 'UNIQUE KEY `' . $keyCode . '` (' . implode(', ', $key) . ')';
		}


		return $result;
	}
}

?>
