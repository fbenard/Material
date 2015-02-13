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

		//$tableTransformer = new \fbenard\Material\Services\Transformers\MySql\CreateTableTransformer();


		//

		$result = [];


		//

		$result[] = 'INSERT';
		$result[] = 'INTO';
		//$result[] = $tableTransformer->transform($query->table);


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
