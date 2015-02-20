<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class InsertQueryTransformer
extends \fbenard\Material\Classes\AbstractQueryTransformer
{
	/**
	 *
	 */

	public function transform($query, $connection)
	{
		//

		$columns = $query->columns;

		foreach ($columns as &$column)
		{
			$column = '`' . $column . '`';
		}


		//

		$values = $query->values;

		foreach ($values as &$value)
		{
			if (is_null($value) === true)
			{
				$value = 'NULL';
			}
			else
			{
				$value = '\'' . $connection->driver->secureString($value) . '\'';
			}
		}


		//

		$result = [];


		//

		$result[] = 'INSERT INTO';
		$result[] = '`' . $query->tableCode . '`';
		$result[] = '(';
		$result[] = implode(', ', $columns);
		$result[] = ')';
		$result[] = 'VALUES';
		$result[] = '(';
		$result[] = implode(', ', $values);
		$result[] = ')';


		//

		if ($query->updateOnDuplicate === true)
		{
			$result[] = 'ON DUPLICATE KEY UPDATE';
			$columns_values = [];

			foreach ($columns as $key => $column)
			{
				$columns_values[] = $column . ' = ' . $values[$key];
			}

			$result[] = implode(', ', $columns_values);
		}


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
