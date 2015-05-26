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
				// Is it a 0:1 or a 0:n relation?

				if
				(
					($property['cardinality'] === '0_1') ||
					($property['cardinality'] === '1_1')
				)
				{
					// Build the relation object

					$objectRelation = $this->buildObject($property);


					// Load the relation object

					$objectRelation->load($object->get($propertyCode));

					
					// Export the relation

					$propertyValue = $objectRelation->export(false);
				}
				else if
				(
					($property['cardinality'] === '0_n') ||
					($property['cardinality'] === '1_n')
				)
				{
					// Get all relations of this object?
				}
			}


			// Store the property

			$result[$propertyCode] = $propertyValue;
		}


		return $result;
	}
}

?>
