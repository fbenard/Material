<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class ReplaceQueryTransformer
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

		$result[] = 'REPLACE INTO';
		$result[] = '`' . $query->tableCode . '`';
		$result[] = '(';
		$result[] = implode(', ', $columns);
		$result[] = ')';
		$result[] = 'VALUES';
		$result[] = '(';
		$result[] = implode(', ', $values);
		$result[] = ')';


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
