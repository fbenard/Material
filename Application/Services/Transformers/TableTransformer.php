<?php

// Namespace

namespace fbenard\Material\Services\Transformers;


/**
 *
 */

class TableTransformer
{
	/**
	 *
	 */

	public function transform_create()
	{
		//

		$result = [];

		
		//

		$result[] = '`' . $this->_code . '`';
		$result[] = '(';


		//

		foreach ($this->_fields as $field)
		{
			$result[] = $field->transform_create();
			$result[] = ',';
		}


		//

		$result[] = ')';


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
