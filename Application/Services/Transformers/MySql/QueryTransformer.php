<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class QueryTransformer
{
	/**
	 *
	 */

	public function transform($query)
	{
		//

		$result = null;

		if ($query->type === 'createTable')
		{
			$result = $this->transform_createTable($query);
		}
		else if ($query->type === 'delete')
		{
			$result = $this->transform_delete($query);
		}
		else if ($query->type === 'drop')
		{
			$result = $this->transform_drop($query);
		}
		else if ($query->type === 'insert')
		{
			$result = $this->transform_insert($query);
		}
		else if ($query->type === 'update')
		{
			$result = $this->transform_update($query);
		}
		else if ($query->type === 'upsert')
		{
			$result = $this->transform_upsert($query);
		}


		return $result;
	}


	/**
	 *
	 */

	public function transform_createTable($query)
	{
		//

		$tableTransformer = new \fbenard\Material\Services\Transformers\MySql\TableTransformer();


		//

		$result = [];


		//

		$result[] = 'CREATE TABLE';
		$result[] = 'IF NOT EXISTS';
		$result[] = $tableTransformer->transform_createTable($query->table);


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
