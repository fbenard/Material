<?php

// Namespace

namespace fbenard\Material\Services\Factories;


/**
 *
 */

class ObjectPropertyFactory
{
	/**
	 *
	 */

	public function buildObjectProperties($model)
	{
		// Build object properties

		$objectProperties = [];

		
		// Parse each property

		foreach ($model['properties'] as $propertyCode => $property)
		{
			// Store the object property

			$objectProperties[$propertyCode] = $this->fixObjectProperty($property);
		}

		
		// Parse each relation

		foreach ($model['relations'] as $relationCode => $relation)
		{
			if
			(
				($relation['cardinality'] === 'zero_one') ||
				($relation['cardinality'] === 'one_one')
			)
			{
				// Build the object property

				$objectProperty =
				[
					'type' => 'integer'
				];


				// Store the object property

				$objectProperties[$relationCode] = $this->fixObjectProperty($objectProperty);
			}
		}


		return $objectProperties;
	}


	/**
	 *
	 */

	public function fixObjectProperty($objectProperty)
	{
		// Ensure objectProperty is an array

		if (is_array($objectProperty) === false)
		{
			$objectProperty = [];
		}


		// Ensure it has the expected structure

		$objectProperty = array_merge
		(
			[
				'type' => null,
			],
			$objectProperty
		);


		return $objectProperty;
	}
}

?>
