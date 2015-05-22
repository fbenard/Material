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
				'cardinality' => null,
				'pivot' => null,
				'type' => null
			],
			$objectProperty
		);


		return $objectProperty;
	}
}

?>
