<?php

// Namespace

namespace fbenard\Material\Services\Managers;


/**
 *
 */

class IndexManager
{
	/**
	 *
	 */

	public function index()
	{
		// List models

		$models = \z\service('manager/model')->listModels();


		// Parse each models

		foreach ($models as $modelCode)
		{
			// Log

			\z\dlogi('Indexing ' . $modelCode . '...');


			// Index the model

			\z\service('manager/model')->indexModel($modelCode);
		}
	}
}

?>
