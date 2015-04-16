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

	public function countModel($modelCode)
	{
		// Count objects

		$result = \z\service('factory/query')
		->select()
		->from($modelCode)
		->count('*', 'nbObjects')
		->execute();


		// Extract the total number of objects

		$result = array_pop($result);
		$result = $result['nbObjects'];
		

		return $result;
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
		// List paths to models

		$paths = \z\service('helper/file')->listFiles(PATH_APPLICATION . 'Config/Models/', '*.json');


		// Parse each path

		$result = [];

		foreach ($paths as $path)
		{
			// Extract the model code

			$modelCode = basename($path, '.json');


			// Get the model

			$model = $this->getModel($modelCode);


			// Skip abstract models

			if ($model['abstract'] === true)
			{
				continue;
			}


			// Store the model

			$result[] = $modelCode;
		}


		return $result;
	}


	/**
	 *
	 */

	public function scrollModel($modelCode, $page = null, $pageSize = null)
	{
		// Define the page size

		if (empty($pageSize) === true)
		{
			$pageSize = \z\pref('splio/goloboard/page/size');
		}


		// Select inputs within the page

		$inputs = \z\service('factory/query')
		->select()
		->from($modelCode)
		->offset($page * $pageSize)
		->limit($pageSize)
		->execute();


		// Parse each input

		$result = [];

		foreach ($inputs as $input)
		{
			// Build an object

			$object = \z\service('factory/object')->buildObject($modelCode);


			// Import the input

			$object->import($input);


			// Store the object

			$result[] = $object;
		}
		

		return $result;
	}
}

?>
