<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class LoadQueryTransformer
extends \fbenard\Material\Classes\AbstractQueryTransformer
{
	/**
	 *
	 */

	public function transform($query, $connector)
	{
		// Prepare result

		$result = [];
		$result[] = 'LOAD DATA';

		if ($query->isLocal === true)
		{
			$result[] = 'LOCAL';
		}

		$result[] = 'INFILE';
		$result[] = '\'' . $query->pathToFile . '\'';
		$result[] = 'INTO TABLE';
		$result[] = '`' . $query->tableCode . '`';
		$result[] = 'FIELDS';
		$result[] = 'TERMINATED BY';
		$result[] = '\',\'';
		$result[] = 'OPTIONALLY ENCLOSED BY';
		$result[] = '\'"\'';
		$result[] = 'LINES';
		$result[] = 'TERMINATED BY';
		$result[] = '\'\\n\'';
		$result[] = 'IGNORE 1 LINES';


		// Build the result
		
		$result = $this->buildResult($result);


		return $result;
	}
}

?>
