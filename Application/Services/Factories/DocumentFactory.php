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

	public function buildDocument($model, $object)
	{
		// Build the document

		$document = array_merge
		(
			$this->convertObjectProperties($model, $object),
			$this->convertObjectRelations($model, $object)
		);


		return $document;
	}


	/**
	 *
	 */

	private function convertObjectProperties($model, $object)
	{
		// Build result

		$result = [];


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


			// Store the property

			$result[$propertyCode] = $propertyValue;
		}


		return $result;
	}


	/**
	 *
	 */

	private function convertObjectRelations($model, $object)
	{
		// Build result

		$result = [];


		// Parse each relation

		foreach ($model['relations'] as $relationCode => $relation)
		{
			//

			if
			(
				($relation['cardinality'] === 'zero_one') ||
				($relation['cardinality'] === 'one_one')
			)
			{
				// Build the relation object

				$objectRelation = \z\service('factory/object')->buildObject($relation['type']);


				// Load the relation object

				$objectRelation->load($object->get($relationCode));

				
				// Store the relation object

				$result[$relationCode] =
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
			else
			{
				// Get all relations of this object
				//$object->get()
			}
		}


		return $result;
	}
}

?>
