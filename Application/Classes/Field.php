<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

class Field
{
	// Attributes

	private $_code = null;
	private $_type = null;
	private $_defaultValue = null;
	private $_isBig = false;
	private $_isIncremented = false;
	private $_isIndex = false;
	private $_isLong = false;
	private $_isMedium = false;
	private $_isNull = true;
	private $_isPrimaryKey = false;
	private $_isShort = false;
	private $_isSmall = false;
	private $_isTiny = false;
	private $_isUnique = false;
	private $_isUnsigned = false;


	/**
	 *
	 */

	public function __construct($fieldCode, $fieldType)
	{
		$this->_code = $fieldCode;
		$this->_type = $fieldType;
	}


	/**
	 *
	 */

	public function __get($attributeCode)
	{
		$attributeCode = '_' . $attributeCode;
		return $this->$attributeCode;
	}


	/**
	 *
	 */

	public function big()
	{
		//

		$this->_isBig = true;


		return $this;
	}


	/**
	 *
	 */

	public function defaultValue($defaultValue)
	{
		//

		$this->_defaultValue = $defaultValue;


		return $this;
	}


	/**
	 *
	 */

	public function increment()
	{
		//

		$this->_isIncremented = true;


		return $this;
	}


	/**
	 *
	 */

	public function index()
	{
		//

		$this->_isIndex = true;


		return $this;
	}


	/**
	 *
	 */

	public function long()
	{
		//

		$this->_isLong = true;


		return $this;
	}


	/**
	 *
	 */

	public function medium()
	{
		//

		$this->_isMedium = true;


		return $this;
	}


	/**
	 *
	 */

	public function notNull()
	{
		//

		$this->_isNull = false;


		return $this;
	}


	/**
	 *
	 */

	public function primaryKey()
	{
		//

		$this->_isIncremented = true;
		$this->_isPrimaryKey = true;
		$this->_isNull = false;


		return $this;
	}


	/**
	 *
	 */

	public function short()
	{
		//

		$this->_isShort = true;


		return $this;
	}


	/**
	 *
	 */

	public function small()
	{
		//

		$this->_isSmall = true;


		return $this;
	}


	/**
	 *
	 */

	public function tiny()
	{
		//

		$this->_isTiny = true;


		return $this;
	}


	/**
	 *
	 */

	public function unique()
	{
		//

		$this->_isUnique = true;


		return $this;
	}


	/**
	 *
	 */

	public function unsigned()
	{
		//

		$this->_isUnsigned = true;


		return $this;
	}
}

?>
