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

	public function duplicateObject(&$object)
	{
		//

		$object->set('id', null);


		//

		$object->save();
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

	public function isObjectLoaded(&$object)
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

	public function resetObject(&$object)
	{
		foreach ($object->properties as $propertyCode => $propertyValue)
		{
			$object->set($propertyCode, null);
		}
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


	/**
	 *
	 */

	public function searchObject(&$object, $query = null, $page = null, $limit = null)
	{
		// Compute size of collection

		$count = \z\service('factory/query')
		->select()
		->count('id', 'nb_objects')
		->from($object->modelCode)
		->execute();

		$size = $count[0]['nb_objects'];
		

		// Compute data
		
		$data = \z\service('factory/query')
		->select()
		->from($object->modelCode)
		->offset($page * \z\pref('splio/goloboard/documents/limit'))
		->limit(\z\pref('splio/goloboard/documents/limit'))
		->execute();


		// Build the result

		$result = array
		(
			'data' => $data,
			'size' => $size
		);


		return $result;
	}
}

?>
