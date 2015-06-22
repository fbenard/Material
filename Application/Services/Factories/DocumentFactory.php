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


			// Is it a relation?

			if (\z\service('helper/object/property')->isRelation($property) === true)
			{
				// Is it a 0:1 or a 0:n relation?

				if
				(
					($property['cardinality'] === '0_1') ||
					($property['cardinality'] === '1_1')
				)
				{
					// Fix the model code

					$relationModelCode = \z\service('factory/model')->fixModelCode($property['type']);


					// Build the relation

					$relation = \z\service('factory/object')->buildObject($relationModelCode);


					// Load the relation

					$relation->load($propertyValue);

					
					// Export the relation

					$propertyValue = $relation->export(false);
				}
				else if
				(
					($property['cardinality'] === '0_n') ||
					($property['cardinality'] === '1_n')
				)
				{
					// Decode sub-property values

					$subPropertyValues = json_decode($propertyValue, true);


					// Parse each sub-property value

					$relations = [];
					
					foreach ($subPropertyValues as $subPropertyValue)
					{
						// Fix the model code

						$relationModelCode = \z\service('factory/model')->fixModelCode($property['type']);


						// Find the relation

						$relation = \z\service('manager/sync/object')->findObject
						(
							$relationModelCode,
							$subPropertyValue['ext_source'],
							$subPropertyValue['ext_id']
						);


						// If the relation is loaded, add it to relations

						if ($relation->isLoaded() === true)
						{
							$relations[] = $relation->export(false);
						}
					}


					// Have we found any relation?

					if (empty($relations) === true)
					{
						$propertyValue = new \stdClass();	
					}
					else
					{
						$propertyValue = $relations;
					}
				}
			}


			// Store the property

			$result[$propertyCode] = $propertyValue;
		}


		return $result;
	}
}

?>
