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


	/**
	 *
	 */

	public function scrollModel($modelCode, $page = null, $limit = null)
	{
		// Define the limit

		if (empty($limit) === true)
		{
			$limit = \z\pref('splio/goloboard/documents/limit');
		}


		// Select inputs within page/limit

		$inputs = \z\service('factory/query')
		->select()
		->from($modelCode)
		->offset($page * $limit)
		->limit($limit)
		->execute();


		//

		foreach ($inputs as $input)
		{
			//

			$object = \z\service('factory/object')->buildObject($modelCode);


			//

			$object->import($input);


			//

			$objects[] = $object;
		}
		

		return [];
	}
}

?>
