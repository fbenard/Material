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
		
		if (is_null($query->engine) === false)
		{
			$result[] = 'ENGINE=' . $query->engine;
		}

		if (is_null($query->charset) === false)
		{
			$result[] = 'DEFAULT CHARSET=' . $query->charset;
		}


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
