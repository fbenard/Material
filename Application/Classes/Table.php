<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

class Table
{
	// Traits

	use \fbenard\Zero\Traits\Get;

	
	// Attributes

	private $_code = null;
	private $_fields = null;
	

	/**
	 *
	 */

	public function __construct($tableCode)
	{
		$this->_code = $tableCode;
		$this->_fields = [];
	}


	/**
	 *
	 */

	private function buildField($fieldCode, $fieldType)
	{
		// Build the field

		$field = new \fbenard\Material\Classes\Field($fieldCode, $fieldType);


		// Store the field

		$this->_fields[] = $field;


		return $field;
	}


	/**
	 *
	 */

	public function date($fieldCode)
	{
		return $this->buildField($fieldCode, __FUNCTION__);
	}


	/**
	 *
	 */

	public function double($fieldCode)
	{
		return $this->buildField($fieldCode, __FUNCTION__);
	}


	/**
	 *
	 */

	public function dateTime($fieldCode)
	{
		return $this->buildField($fieldCode, __FUNCTION__);
	}


	/**
	 *
	 */

	public function float($fieldCode)
	{
		return $this->buildField($fieldCode, __FUNCTION__);
	}


	/**
	 *
	 */

	public function integer($fieldCode)
	{
		return $this->buildField($fieldCode, __FUNCTION__);
	}


	/**
	 *
	 */

	public function primaryKey($fieldCode)
	{
		$this->_primaryKey = $fieldCode;
	}


	/**
	 *
	 */

	public function real($fieldCode)
	{
		return $this->buildField($fieldCode, __FUNCTION__);
	}


	/**
	 *
	 */

	public function string($fieldCode)
	{
		return $this->buildField($fieldCode, __FUNCTION__);
	}


	/**
	 *
	 */

	public function text($fieldCode)
	{
		return $this->buildField($fieldCode, __FUNCTION__);
	}


	/**
	 *
	 */

	public function time($fieldCode)
	{
		return $this->buildField($fieldCode, __FUNCTION__);
	}


	/**
	 *
	 */

	public function timestamp($fieldCode)
	{
		return $this->buildField($fieldCode, __FUNCTION__);
	}
}

?>
