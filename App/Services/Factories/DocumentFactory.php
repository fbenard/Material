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

				if (\z\service('helper/object/property')->is01Relation($property) === true)
				{
					// Build the relation

					$relation = \z\service('factory/object')->buildObject($property['model']);


					// Load the relation

					$relation->load($propertyValue);

					
					// Export the relation

					$propertyValue = $relation->export(false);
				}
				else if (\z\service('helper/object/property')->is0NRelation($property) === true)
				{
					// Decode sub-property values

					$subPropertyValues = json_decode($propertyValue, true);


					// Parse each sub-property value

					$relations = [];
					
					if (is_array($subPropertyValues) === true)
					{
						foreach ($subPropertyValues as $subPropertyValue)
						{
							// Build the relation

							$relation = \z\service('factory/object')->buildObject($property['model']);


							// Load the relation

							$relation->load($subPropertyValue);


							// Export the relation

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
