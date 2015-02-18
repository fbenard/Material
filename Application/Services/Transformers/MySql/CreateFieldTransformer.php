<?php

// Namespace

namespace fbenard\Material\Services\Transformers\MySql;


/**
 *
 */

class CreateFieldTransformer
{
	/**
	 *
	 */

	public function transform($field)
	{
		//

		$result = [];


		//

		$result[] = '`' . $field->code . '`';
		

		//

		$types =
		[
			'date' => 'DATE',
			'dateTime' => 'DATETIME',
			'double' => 'DOUBLE',
			'float' => 'FLOAT',
			'integer' => 'INT',
			'integer.medium' => 'MEDIUMINT',
			'integer.small' => 'SMALLINT',
			'integer.tiny' => 'TINYINT',
			'integer.big' => 'BIGINT',
			'real' => 'REAL',
			'string' => 'VARCHAR(255)',
			'text' => 'TEXT',
			'text.medium' => 'MEDIUMTEXT',
			'text.tiny' => 'TINYTEXT',
			'text.long' => 'LONGTEXT',
			'time' => 'TIME',
			'timestamp' => 'TIMESTAMP',
		];

		
		//
		
		$typeCode = $field->type;

		if ($field->isLong === true)
		{
			$typeCode .= '.long';
		}

		if ($field->isMedium === true)
		{
			$typeCode .= '.medium';
		}

		if ($field->isShort === true)
		{
			$typeCode .= '.short';
		}

		if ($field->isSmall === true)
		{
			$typeCode .= '.small';
		}

		if ($field->isTiny === true)
		{
			$typeCode .= '.tiny';
		}

		$result[] = $types[$typeCode];

		
		//

		if ($field->isUnsigned === true)
		{
			$result[] = 'UNSIGNED';
		}


		//

		if ($field->isNull === true)
		{
			//
			
			$result[] = 'NULL';


			//

			if (is_null($field->defaultValue) === true)
			{
				$result[] = 'DEFAULT NULL';
			}
			else if (empty($field->defaultValue) === false)
			{
				$result[] = 'DEFAULT';
				$result[] = '\'' .$field->defaultValue . '\'';
			}
		}
		else
		{
			$result[] = 'NOT NULL';
		}


		//

		if ($field->isIncremented === true)
		{
			$result[] = 'AUTO_INCREMENT';
		}


		//

		if ($field->isUnique === true)
		{
			$result[] = 'UNIQUE';
		}


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
