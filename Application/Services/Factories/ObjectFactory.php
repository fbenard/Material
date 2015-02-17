<?php

// Namespace

namespace fbenard\Material\Services\Factories;


/**
 *
 */

class ObjectFactory
{
	/**
	 *
	 */

	public function buildObject($modelCode)
	{
		// Get the model

		$model = \z\service('manager/model')->getModel($modelCode);


		// Build object properties

		$objectProperties = \z\service('factory/object/property')->buildObjectProperties($model);


		// Build the object

		$object = new \fbenard\Material\Classes\Object($modelCode, $objectProperties);


		return $object;
	}
}

?>
