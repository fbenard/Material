<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class CreateTableTransformer
{
	/**
	 *
	 */

	public function transform($table)
	{
		//

		$fieldTransformer = new \fbenard\Material\Services\Transformers\MySql\CreateFieldTransformer();


		//

		$fields = [];

		foreach ($table->fields as $field)
		{
			$fields[] = $fieldTransformer->transform($field);
		}

		if (is_null($table->primaryKey) === false)
		{
			$fields[] = 'PRIMARY KEY (`' . $table->primaryKey . '`)';
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
