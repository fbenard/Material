<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class DropQueryTransformer
{
	/**
	 *
	 */

	public function transform($query)
	{
		//

		$result = [];


		//

		$result[] = 'DROP TABLE';
		$result[] = 'IF EXISTS';
		$result[] = '`' . $query->tableCode . '`';


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
