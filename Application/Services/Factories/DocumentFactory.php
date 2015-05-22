<?php

// Namespace

namespace fbenard\Material\Services\Factories;


/**
 *
 */

class DocumentFactory
{
	/**
	 *
	 */

	public function buildDocument($modelCode, $object)
	{
		// Build result

		$result = [];


		// Get the model

		$model = \z\service('manager/model')->getModel($modelCode);


		// Parse each property

		foreach ($model['properties'] as $propertyCode => $property)
		{
			// Get the property value

			$propertyValue = $object->get($propertyCode);


			// Temporary hack

			if ($property['type'] === 'datetime')
			{			
				//

				if ($propertyValue === '0000-00-00 00:00:00')
				{
					$propertyValue = null;
				}


				//

				if (empty($propertyValue) === false)
				{
					//

					$date = new \DateTime($propertyValue);
					$propertyValue = $date->format('Y-m-d') . 'T' . $date->format('H:i:s');
				}
			}


			// Relations require an additional conversion

			if (\z\service('helper/object/property')->isRelation($property) === true)
			{
				//

				if
				(
					($property['cardinality'] === 'zero_one') ||
					($property['cardinality'] === 'one_one')
				)
				{
					// Build the relation object

					$objectRelation = $this->buildObject($property);


					// Load the relation object

					$objectRelation->load($object->get($propertyCode));

					
					//

					$propertyValue =
					[
						'id' => $objectRelation->get('id'),
						'ext_source' => $objectRelation->get('ext_source'),
						'ext_id' => $objectRelation->get('ext_id'),
						'ext_code' => $objectRelation->get('ext_code'),
						'name' => $objectRelation->get('name'),
						'url' => $objectRelation->get('url'),
						'url_avatar' => $objectRelation->get('url_avatar')
					];
				}
				else if
				(
					($property['cardinality'] === 'zero_many') ||
					($property['cardinality'] === 'one_many')
				)
				{
					// Get all relations of this object
					//$object->get()
				}
			}


			// Store the property

			$result[$propertyCode] = $propertyValue;
		}


		return $result;
	}
}

?>
