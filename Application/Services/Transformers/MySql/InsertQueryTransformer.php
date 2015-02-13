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
		$result[] = $query->tableCode;
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
