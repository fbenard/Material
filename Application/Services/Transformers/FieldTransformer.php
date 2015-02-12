<?php

// Namespace

namespace fbenard\Material\Services\Transformers;


/**
 *
 */

class FieldTransformer
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
			'string' => 'VARCHAR',
			'text' => 'TEXT',
			'text.medium' => 'MEDIUMTEXT',
			'text.tiny' => 'TINYTEXT',
			'text.long' => 'LONGTEXT',
			'time' => 'TIME',
			'timestamp' => 'TIMESTAMP',
		];

		
		//
		
		$typeCode = $this->_type;

		if ($this->_isLong === true)
		{
			$typeCode .= '.long';
		}

		if ($this->_isMedium === true)
		{
			$typeCode .= '.medium';
		}

		if ($this->_isShort === true)
		{
			$typeCode .= '.short';
		}

		if ($this->_isSmall === true)
		{
			$typeCode .= '.small';
		}

		if ($this->_isTiny === true)
		{
			$typeCode .= '.tiny';
		}

		$result[] = $types[$typeCode];

		
		/*
		public $_isIndex = false;
		*/

		//

		if ($this->_isUnsigned === true)
		{
			$result[] = 'UNSIGNED';
		}


		//

		if ($this->_isNull === true)
		{
			$result[] = 'NULL';
		}


		//

		if (empty($this->_defaultValue) === false)
		{
			$result[] = 'DEFAULT';
			$result[] = '\'' .$this->_defaultValue . '\'';
		}


		//

		if
		(
			($this->_isIncremented === true) &&
			($this->_isPrimaryKey === false)
		)
		{
			$result[] = 'AUTO_INCREMENT';
		}


		//

		if ($this->_isUnique === true)
		{
			$result[] = 'UNIQUE';
		}


		//

		if ($this->_isPrimaryKey === true)
		{
			$result[] = 'PRIMARY KEY';
		}


		//
		
		$result = implode(' ', $result);


		return $result;
	}
}

?>
