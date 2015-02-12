<?php

// Namespace

namespace fbenard\Material\Services\Transformers;


/**
 *
 */

class QueryTransformer
{
	/**
	 *
	 */

	public function transform()
	{
		//

		$result = null;

		if ($this->_type === 'create')
		{
			$result = $this->transform_create();
		}
		else if ($this->_type === 'delete')
		{
			$result = $this->transform_delete();
		}
		else if ($this->_type === 'drop')
		{
			$result = $this->transform_drop();
		}
		else if ($this->_type === 'insert')
		{
			$result = $this->transform_insert();
		}
		else if ($this->_type === 'update')
		{
			$result = $this->transform_update();
		}
		else if ($this->_type === 'upsert')
		{
			$result = $this->transform_upsert();
		}


		return $result;
	}


	/**
	 *
	 */

	public function transform_create()
	{
		//

		$result = [];


		//

		$result[] = 'CREATE TABLE';
		$result[] = $this->_table->transform_create();


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
