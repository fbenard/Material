<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class TableTransformer
{
	/**
	 *
	 */

	public function transform_createTable($table)
	{
		//

		$fieldTransformer = new \fbenard\Material\Services\Transformers\MySql\FieldTransformer();


		//

		$fields = [];

		foreach ($table->fields as $field)
		{
			$fields[] = $fieldTransformer->transform_createTable($field);
		}


		//

		$result = [];

		
		//

		$result[] = '`' . $table->code . '`';
		$result[] = '(';
		$result[] = implode(', ', $fields);
		$result[] = ')';


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
