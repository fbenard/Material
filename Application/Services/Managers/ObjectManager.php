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

	public function importObject(&$object, $input)
	{
		foreach ($object->properties as $propertyCode => $property)
		{
			if (array_key_exists($propertyCode, $input) === true)
			{
				$object->set($propertyCode, $input[$propertyCode]);
			}
		}
	}

	
	/**
	 *
	 */

	public function loadObject(&$object, $objectId)
	{
		//

		$input = \z\service('factory/query')
		->select()
		->from($object->modelCode)
		->where('id', '=', $objectId);


		//

		$this->import($object, $input);
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
