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
		// Delete the index

		$this->deleteIndex($indexCode);


		// Create the index

		\z\service('driver/db/es')->indices()->create($index);
	}


	/**
	 *
	 */

	public function deleteIndex($indexCode)
	{
		// Delete existing index

		if (\z\service('driver/db/es')->indices()->exists(['index' => $indexCode]) === true)
		{
			\z\service('driver/db/es')->indices()->delete(['index' => $indexCode]);
		}
	}


	/**
	 *
	 */

	public function deleteAllIndexes()
	{
		\z\service('driver/db/es')->indices()->delete(['index' => '_all']);
	}
}

?>
