<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class SelectQueryTransformer
{
	/**
	 *
	 */

	public function transform($query)
	{
		//

		$result = [];


		//

		$result[] = 'SELECT';
		$result[] = '*';
		$result[] = 'FROM';
		$result[] = $query->from;


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
