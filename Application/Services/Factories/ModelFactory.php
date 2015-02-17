<?php

// Namespace

namespace fbenard\Material\Services\Factories;


/**
 *
 */

class ModelFactory
{
	/**
	 *
	 */

	public function buildModel($modelCode)
	{
		// Check whether the model exists

		$pathToModel = PATH_APPLICATION . 'Config/Models/' . $modelCode . '.json';

		if (file_exists($pathToModel) === false)
		{
			\z\e
			(
				EXCEPTION_MODEL_NOT_FOUND,
				[
					'modelCode' => $modelCode,
					'pathToModel' => $pathToModel
				]
			);
		}


		// Decode the model

		$rawModel = file_get_contents($pathToModel);
		$model = json_decode($rawModel, true);


		// Fix the model

		$model = $this->fixModel($model);


		// Does the model extend a base model?

		if (empty($model['extends']) === false)
		{
			// Build the base model

			$baseModel = $this->buildModel($model['extends']);


			// Merge properties and relations

			$model['properties'] = array_merge
			(
				$baseModel['properties'],
				$model['properties']
			);

			$model['relations'] = array_merge
			(
				$baseModel['relations'],
				$model['relations']
			);
		}


		return $model;
	}


	/**
	 *
	 */

	public function fixModel($model)
	{
		// Ensure model is an array

		if (is_array($model) === false)
		{
			$model = [];
		}


		// Ensure it has the expected structure

		$model = array_merge
		(
			[
				'extends' => null,
				'properties' => [],
				'relations' => []
			],
			$model
		);


		return $model;
	}
}

?>
