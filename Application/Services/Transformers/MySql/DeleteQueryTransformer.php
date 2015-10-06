<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class DeleteQueryTransformer
extends \fbenard\Material\Classes\AbstractQueryTransformer
{
	/**
	 *
	 */

	public function transform($query, $connection)
	{
		// Prepare the result

		$result =
		[
			'DELETE',
			'FROM',
			'`' . $query->from . '`',
			$this->transformWhere($query, $connection)
		];
		

		// Build the result
		
		$result = $this->buildResult($result);


		return $result;
	}


	/**
	 *
	 */

	private function transformWhere($query, $connection)
	{
		//

		$result = [];

		
		//

		$where = $query->where;

		if (empty($where) === false)
		{
			$result[] = 'WHERE';
			$conditions = [];

			foreach ($where as $condition)
			{
				$conditions[] = '`' . $condition[0] . '` ' . $condition[1] . ' \'' . $condition[2] . '\'';
			}

			$result[] = implode(' AND ', $conditions);
		}
		

		// Build the result
		
		$result = $this->buildResult($result, ' ');


		return $result;
	}
}

?>
