<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class CreateQueryTransformer
{
	/**
	 *
	 */

	public function transform($query)
	{
		//

		$tableTransformer = new \fbenard\Material\Services\Transformers\MySql\CreateTableTransformer();


		//

		$result = [];


		//

		$result[] = 'CREATE TABLE';
		$result[] = $tableTransformer->transform($query->table);


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
