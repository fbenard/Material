<?php

// Namespace

namespace fbenard\Material\Services\Managers;


/**
 *
 */

class ModelManager
{
	// Attributes

	private $_models = null;


	/**
	 *
	 */

	public function __construct()
	{
		$this->_models = [];
	}


	/**
	 *
	 */

	public function getModel($modelCode)
	{
		// As the model already been retrieved?

		if (array_key_exists($modelCode, $this->_models) === false)
		{
			// Build the model

			$model = \z\service('factory/model')->buildModel($modelCode);


			// Store the model

			$this->_models[$modelCode] = $model;
		}


		// Get the model

		$model = $this->_models[$modelCode];


		return $model;
	}


	/**
	 *
	 */

	public function listModels()
	{
		//

		$paths = \z\service('helper/file')->listFiles(PATH_APPLICATION . 'Config/Models/', '*.json');


		//

		$result = [];

		foreach ($paths as $path)
		{
			$modelCode = basename($path, '.json');
			$result[] = $modelCode;
		}


		return $result;
	}
}

?>
