<?php

// Namespace

namespace fbenard\Material\Services\Managers;


/**
 *
 */

class ObjectManager
{
	/**
	 *
	 */

	public function clearObject(&$object)
	{
		//
		
		\z\service('factory/query')
		->delete()
		->from($this->_nameSingular)
		->execute();
	}

	
	/**
	 *
	 */

	public function deleteObject(&$object)
	{
		//
		
		\z\service('factory/query')
		->delete()
		->from($this->_nameSingular)
		->where($object->id, '=', $object->get($object->id))
		->execute();
	}

	
	/**
	 *
	 */

	public function duplicateObject(&$object)
	{
		// Extract object properties

		$objectProperties = $object->properties;


		// Parse each object property

		/*
		foreach ($objectProperties as $propertyCode => $propertyValue)
		{
			if (is_array($propertyValue) === true)
			{
				foreach ($propertyValue as $subPropertyCode => $subPropertyValue)
				{
					if (is_object($subPropertyValue) === true)
					{
						$objectProperties[$propertyCode][$subPropertyCode] = $this->duplicateObject($subPropertyValue);
					}
				}
			}
			else if (is_object($propertyValue) === true)
			{
				$objectProperties[$propertyCode] = $this->duplicateObject($propertyValue);
			}
		}
		*/


		// Build a new object

		$result = \z\service('factory/object')->buildObject($object->modelCode);

		
		// Replace object properties

		$result->properties = $objectProperties;


		return $result;
	}

	
	/**
	 *
	 */

	public function exportObject(&$object, $exportRelations = true)
	{
		//

		$result = [];

		foreach ($object->properties as $propertyCode => $propertyValue)
		{
			if (is_array($propertyValue) === true)
			{
				foreach ($propertyValue as &$subPropertyValue)
				{
					if
					(
						(is_object($subPropertyValue) === true) &&
						($exportRelations === true)
					)
					{
						$subPropertyValue = $this->exportObject($subPropertyValue);
					}
				}
			}
			else if
			(
				(is_object($propertyValue) === true) &&
				($exportRelations === true)
			)
			{
				$propertyValue = $this->exportObject($propertyValue);
			}


			//

			$result[$propertyCode] = $propertyValue;
		}


		return $result;
	}


	/**
	 *
	 */

	public function getObjectProperty($object, $propertyCode, $page = null, $pageSize = null)
	{
		// Check whether property exists

		if (array_key_exists($propertyCode, $object->properties) === false)
		{
			\z\e
			(
				EXCEPTION_OBJECT_PROPERTY_NOT_FOUND,
				[
					'propertyCode' => $propertyCode,
					'properties' => $object->properties
				]
			);
		}


		// Get the property value

		$propertyValue = $object->properties[$propertyCode];


		return $propertyValue;
	}

	
	/**
	 *
	 */

	public function importObject(&$object, $input)
	{
		// Make sure input is an array

		if (is_array($input) === false)
		{
			$input = [];
		}

		
		//

		foreach ($object->properties as $propertyCode => $propertyValue)
		{
			if (array_key_exists($propertyCode, $input) === true)
			{
				$object->set($propertyCode, $input[$propertyCode]);
			}
			else
			{
				$object->set($propertyCode, null);
			}
		}
	}

	
	/**
	 *
	 */

	public function indexObject(&$object)
	{
		// Build the document

		$document = \z\service('factory/document')->buildDocument($object->modelCode, $object);


		// Store the document

		\z\service('manager/document')->indexDocument
		(
			$object->modelCode,
			$object->modelCode,
			$document,
			$object->modelCode . ':' . $object->get('ext_source') . ':' . $object->get('ext_id')
			//$object->get($object->id)
		);
	}

	
	/**
	 *
	 */

	public function isObjectLoaded($object)
	{
		//

		if (empty($object->get($object->id)) === true)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	
	/**
	 *
	 */

	public function loadObject(&$object, $objectId)
	{
		//

		$inputs = \z\service('factory/query')
		->select()
		->from($object->modelCode)
		->where($object->id, '=', $objectId)
		->execute();


		//

		$input = array_shift($inputs);


		//

		$this->importObject($object, $input);
	}


	/**
	 *
	 */

	public function onObjectSave($eventCode, \fbenard\Material\Events\ObjectSaveEvent $event)
	{
		$this->indexObject($event->object);
	}


	/**
	 *
	 */

	public function resetObject(&$object)
	{
		// Parse each property

		foreach ($object->properties as $propertyCode => $propertyValue)
		{
			// Set it to NULL
			
			$object->set($propertyCode, null);
		}
	}


	/**
	 *
	 */

	public function saveObject(&$object, $properties = null)
	{
		// Dispatch pre event

		\z\dispatch
		(
			EVENT_OBJECT_SAVE_PRE,
			new \fbenard\Material\Events\ObjectSaveEvent($this, $object, $properties)
		);


		// Get the model

		$model = \z\service('manager/model')->getModel($object->modelCode);


		// Build initial properties

		$initialProperties = array_keys($model['properties']);

		if (is_array($properties) === true)
		{
			$initialProperties = $properties;
		}


		// Select properties that will be saved

		$finalProperties = [];

		foreach ($model['properties'] as $propertyCode => $property)
		{
			// Skip the property if not an initial one

			if (in_array($propertyCode, $initialProperties) === false)
			{
				continue;
			}


			// Skip the object ID

			if ($propertyCode === $object->id)
			{
				continue;
			}


			// Skip 0:n cardinalities

			if
			(
				($property['cardinality'] === '0_n') ||
				($property['cardinality'] === '1_n')
			)
			{
				continue;
			}


			// Set the property value

			$finalProperties[$propertyCode] = $object->get($propertyCode);
		}


		// Build the query

		$query = \z\service('factory/query')
		->insert()
		->into($object->modelCode)
		->columns(array_keys($finalProperties))
		->values(array_values($finalProperties))
		->updateOnDuplicate();


		// Save the object

		$result = $query->execute();


		// Update the ID

		if ($object->isLoaded() === false)
		{			
			$id = $query->connection->driver->getLastId();
			$object->set($object->id, $id);
		}


		// Dispatch post event

		\z\dispatch
		(
			EVENT_OBJECT_SAVE_POST,
			new \fbenard\Material\Events\ObjectSaveEvent($this, $object, $properties)
		);
	}


	/**
	 *
	 */

	public function setObjectProperty(&$object, $propertyCode, $propertyValue)
	{
		// Extract object properties

		$objectProperties = $object->properties;


		// Check whether property exists

		if (array_key_exists($propertyCode, $objectProperties) === false)
		{
			\z\e
			(
				EXCEPTION_OBJECT_PROPERTY_NOT_FOUND,
				[
					'propertyCode' => $propertyCode,
					'properties' => $objectProperties
				]
			);
		}


		// Set the property value

		$objectProperties[$propertyCode] = $propertyValue;


		// Replace object properties

		$object->properties = $objectProperties;
	}
}

?>
