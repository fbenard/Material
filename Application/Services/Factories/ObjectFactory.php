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


		// Build the object

		$object = new \fbenard\Material\Classes\Object
		(
			$modelCode,
			array_keys($model['properties'])
		);


		return $object;
	}
}

?>
