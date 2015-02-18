<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class DropQueryTransformer
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
			'DROP TABLE',
			'IF EXISTS',
			'`' . $query->tableCode . '`'
		];
		

		// Build the result
		
		$result = $this->buildResult($result);


		return $result;
	}
}

?>
