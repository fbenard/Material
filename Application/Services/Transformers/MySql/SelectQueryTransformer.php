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
		$result[] = '`' . $query->from . '`';
		
		if (is_null($query->limit) === false)
		{		
			$result[] = 'LIMIT';
			$result[] = $query->limit;
		}

		if (is_null($query->offset) === false)
		{		
			$result[] = 'OFFSET';
			$result[] = $query->offset;
		}


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
