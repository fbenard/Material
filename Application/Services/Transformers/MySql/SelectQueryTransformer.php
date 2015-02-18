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
			$this->transformFields($query),
			'FROM',
			'`' . $query->from . '`',
			$this->transformLimit($query),
			$this->transformOffset($query),
		];
		

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
			$result[] = $fieldCode;
		}

		
		//

		$counts = $query->counts;

		foreach ($counts as $fieldCode => $alias)
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

		if (empty($offset) === false)
		{		
			$result[] = 'OFFSET';
			$result[] = $offset;
		}
		

		// Build the result
		
		$result = $this->buildResult($result);


		return $result;
	}
}

?>
