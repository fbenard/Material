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
		// Build columns and values

		$columns = $query->columns;
		$values = $query->values;

		foreach ($columns as $key => $column)
		{
			// Skip the ID

			if ($column === 'id')
			{
				unset($columns[$key]);
				unset($values[$key]);
				continue;
			}


			// Store the column

			$columns[$key] = '`' . $column . '`';


			// Store the value

			if (is_null($values[$key]) === true)
			{
				$values[$key] = 'NULL';
			}
			else
			{
				$values[$key] = '\'' . $connection->driver->secureString($values[$key]) . '\'';
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
			$columns_values = [];

			foreach ($columns as $key => $column)
			{
				$columns_values[] = $column . ' = ' . $values[$key];
			}

			$result[] = 'ON DUPLICATE KEY UPDATE';
			$result[] = implode(', ', $columns_values);
		}


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
