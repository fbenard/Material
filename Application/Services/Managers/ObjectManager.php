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
		->where('id', '=', $this->getId())
		->execute();
	}

	
	/**
	 *
	 */

	public function exportObject(&$object)
	{
		return $object->properties;
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
		// Get the model

		$model = \z\service('manager/model')->getModel($object->modelCode);


		// Build the document

		$document = \z\service('factory/document')->buildDocument($model, $object);


		// Store the document

		\z\service('manager/document')->indexDocument
		(
			$object->modelCode,
			$object->modelCode,
			$document,
			$object->get('id')
		);
	}

	
	/**
	 *
	 */

	public function isObjectLoaded($object)
	{
		//

		if (empty($object->get('id')) === true)
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
		->where('id', '=', $objectId)
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
		//$this->indexObject($event->object);
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

	public function saveObject(&$object)
	{
		// Dispatch pre event

		\z\dispatch
		(
			EVENT_OBJECT_SAVE_PRE,
			new \fbenard\Material\Events\ObjectSaveEvent($this, $object)
		);


		// Build the query

		$query = \z\service('factory/query')
		->insert()
		->into($object->modelCode)
		->columns(array_keys($object->properties))
		->values(array_values($object->properties))
		->updateOnDuplicate();


		// Save the object

		$result = $query->execute();


		// Update the ID

		$id = $query->connection->driver->getLastId();
		$object->set('id', $id);


		// Dispatch post event

		\z\dispatch
		(
			EVENT_OBJECT_SAVE_POST,
			new \fbenard\Material\Events\ObjectSaveEvent($this, $object)
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
