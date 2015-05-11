<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

class Object
{
	// Traits

	use \fbenard\Zero\Traits\GetTrait;
	use \fbenard\Zero\Traits\SetTrait;


	// Attributes

	private $_modelCode = null;
	private $_properties = null;


	/**
	 *
	 */

	public function __construct($modelCode, $objectProperties = null)
	{
		// Ensure properties is an array

		if (is_array($objectProperties) === false)
		{
			$objectProperties = [];
		}


		// Build properties

		foreach ($objectProperties as $propertyCode => $property)
		{
			$this->_properties[$propertyCode] = null;
		}


		// Store model code

		$this->_modelCode = $modelCode;
	}

	
	/**
	 *
	 */

	public function clear()
	{
		return \z\service('manager/object')->clearObject($this);
	}


	/**
	 *
	 */

	public function delete()
	{
		return \z\service('manager/object')->deleteObject($this);
	}


	/**
	 *
	 */

	public function export()
	{
		return \z\service('manager/object')->exportObject($this);
	}


	/**
	 *
	 */

	public function get($propertyCode, $page = null, $pageSize = null)
	{
		return \z\service('manager/object')->getObjectProperty($this, $propertyCode, $page, $pageSize);
	}


	/**
	 *
	 */

	public function import($input)
	{
		return \z\service('manager/object')->importObject($this, $input);
	}


	/**
	 *
	 */

	public function index()
	{
		return \z\service('manager/object')->indexObject($this);
	}


	/**
	 *
	 */

	public function isLoaded()
	{
		return \z\service('manager/object')->isObjectLoaded($this);
	}


	/**
	 *
	 */

	public function load($objectId)
	{
		return \z\service('manager/object')->loadObject($this, $objectId);
	}


	/**
	 *
	 */

	public function reset()
	{
		return \z\service('manager/object')->resetObject($this);
	}


	/**
	 *
	 */

	public function save()
	{
		return \z\service('manager/object')->saveObject($this);
	}


	/**
	 *
	 */

	public function set($propertyCode, $propertyValue)
	{
		return \z\service('manager/object')->setObjectProperty($this, $propertyCode, $propertyValue);
	}
}

?>
