<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class InsertQueryTransformer
{
	/**
	 *
	 */

	public function transform($query)
	{
		//

		$columns = $query->columns;
		$values = $query->values;

		foreach ($columns as &$column)
		{
			$column = '`' . $column . '`';
		}

		foreach ($values as &$value)
		{
			$value = '\'' . $value . '\'';
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
