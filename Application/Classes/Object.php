<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

class Object
{
	// Traits

	use \fbenard\Zero\Traits\Get;
	use \fbenard\Zero\Traits\Set;


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

	public function duplicate()
	{
		return \z\service('manager/object')->duplicateObject($this);
	}


	/**
	 *
	 */

	public function export($input)
	{
		return \z\service('manager/object')->exportObject($this);
	}


	/**
	 *
	 */

	public function get($propertyCode)
	{
		// Check whether property exists

		if (array_key_exists($propertyCode, $this->_properties) === false)
		{
			\z\e
			(
				EXCEPTION_OBJECT_PROPERTY_NOT_FOUND,
				[
					'propertyCode' => $propertyCode,
					'properties' => $this->_properties
				]
			);
		}


		// Get the property value

		$propertyValue = $this->_properties[$propertyCode];


		return $propertyValue;
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

	public function load($objectId)
	{
		return \z\service('manager/object')->loadObject($this, $objectId);
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

	public function search($query = null, $page = null, $limit = null)
	{
		return \z\service('manager/object')->searchObject($this, $query, $page, $limit);
	}


	/**
	 *
	 */

	public function set($propertyCode, $propertyValue)
	{
		// Check whether property exists

		if (array_key_exists($propertyCode, $this->_properties) === false)
		{
			\z\e
			(
				EXCEPTION_OBJECT_PROPERTY_NOT_FOUND,
				[
					'propertyCode' => $propertyCode,
					'properties' => $this->_properties
				]
			);
		}


		// Store the property value

		$this->_properties[$propertyCode] = $propertyValue;
	}
}

?>
