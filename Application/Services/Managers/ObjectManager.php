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
	}

	
	/**
	 *
	 */

	public function deleteObject(&$object)
	{
	}

	
	/**
	 *
	 */

	public function duplicateObject(&$object)
	{
	}

	
	/**
	 *
	 */

	public function initializeObject(&$object, $initialObject)
	{
		foreach ($object->properties as $propertyCode => $property)
		{
			if (array_key_exists($propertyCode, $initialObject) === true)
			{
				$object->set($propertyCode, $initialObject[$propertyCode]);
			}
		}
	}

	
	/**
	 *
	 */

	public function loadObject(&$object, $objectId)
	{
		//

		$initialObject = \z\service('factory/query')
		->select()
		->from($object->modelCode)
		->where('id', '=', $objectId);


		//

		$this->initializeObject($object, $initialObject);
	}


	/**
	 *
	 */

	public function saveObject(&$object)
	{
		// Save the object

		\z\service('factory/query')
		->insert()
		->into($object->modelCode)
		->columns(array_keys($object->properties))
		->values(array_values($object->properties))
		->updateOnDuplicate()
		->execute();
	}
}

?>
