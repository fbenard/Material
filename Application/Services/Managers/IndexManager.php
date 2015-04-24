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

	public function createIndex($indexCode, $index)
	{
		// Delete existing index

		if (\z\service('driver/db/es')->indices()->exists(['index' => $indexCode]) === true)
		{
			\z\service('driver/db/es')->indices()->delete(['index' => $indexCode]);
		}


		// Create the index

		\z\service('driver/db/es')->indices()->create($index);
	}


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
