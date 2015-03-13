<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class SelectQueryTransformer
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
			'SELECT',
			$this->transformDistinct($query, $connection),
			$this->transformFields($query, $connection),
			'FROM',
			'`' . $query->from . '`',
			$this->transformWhere($query, $connection),
			$this->transformGroupBy($query, $connection),
			$this->transformOrderBy($query, $connection),
			$this->transformLimit($query, $connection),
			$this->transformOffset($query, $connection)
		];
		

		// Build the result
		
		$result = $this->buildResult($result);


		return $result;
	}


	/**
	 *
	 */

	public function transformDistinct($query, $connection)
	{
		//

		$result = [];

		
		//

		if ($query->isDistinct === true)
		{
			$result[] = 'DISTINCT';
		}


		// Build the result
		
		$result = $this->buildResult($result);


		return $result;
	}


	/**
	 *
	 */

	private function transformFields($query, $connection)
	{
		//

		$result = [];

		
		//

		$fields = $query->fields;

		foreach ($fields as $fieldCode)
		{
			$result[] = '`' . $fieldCode . '`';
		}

		
		//

		$count = $query->count;

		foreach ($count as $fieldCode => $alias)
		{
			$result[] = 'COUNT(`' . $fieldCode . '`) AS ' . $alias;
		}

		
		//

		if (empty($result) === true)
		{
			$result[] = '*';
		}
		

		// Build the result
		
		$result = $this->buildResult($result, ', ');


		return $result;
	}


	/**
	 *
	 */

	private function transformGroupBy($query, $connection)
	{
		//

		$result = [];

		
		//

		$groupBy = $query->groupBy;

		if (empty($groupBy) === false)
		{
			$result[] = 'GROUP BY';
			$fields = [];

			foreach ($groupBy as $fieldCode)
			{
				$fields[] = '`' . $fieldCode . '`';
			}

			$result[] = implode(', ', $fields);
		}
		

		// Build the result
		
		$result = $this->buildResult($result, ' ');


		return $result;
	}


	/**
	 *
	 */

	private function transformLimit($query, $connection)
	{
		// Prepare the result

		$result = [];


		// Add the limit

		$limit = $query->limit;

		if (empty($limit) === false)
		{		
			$result[] = 'LIMIT';
			$result[] = $limit;
		}
		

		// Build the result
		
		$result = $this->buildResult($result);


		return $result;
	}


	/**
	 *
	 */

	private function transformOffset($query, $connection)
	{
		// Prepare the result

		$result = [];


		// Add the offset

		$offset = $query->offset;

		if (is_null($offset) === false)
		{		
			$result[] = 'OFFSET';
			$result[] = $offset;
		}
		

		// Build the result
		
		$result = $this->buildResult($result);


		return $result;
	}


	/**
	 *
	 */

	private function transformOrderBy($query, $connection)
	{
		//

		$result = [];

		
		//

		$orderBy = $query->orderBy;

		if (empty($orderBy) === false)
		{
			$result[] = 'ORDER BY';
			$fields = [];

			foreach ($orderBy as $fieldCode => $direction)
			{
				$fields[] = '`' . $fieldCode . '` ' . strtoupper($direction);
			}

			$result[] = implode(', ', $fields);
		}
		

		// Build the result
		
		$result = $this->buildResult($result, ' ');


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
