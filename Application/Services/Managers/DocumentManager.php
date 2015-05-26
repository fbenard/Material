<?php

// Namespace

namespace fbenard\Material\Services\Managers;


/**
 *
 */

class DocumentManager
{
	/**
	 *
	 */

	public function deleteDocument($indexCode, $indexType, $documentId)
	{
		// Build arguments

		$arguments =
		[
			'index' => $indexCode,
			'type' => $indexType,
			'id' => $documentId
		];


		// Delete the document

		\z\service('driver/db/es')->delete($arguments);
	}


	/**
	 *
	 */

	public function getDocument($modelCode, $documentId)
	{
		//

		$document = \z\service('driver/db/es')->get
		(
			[
				'index' => $modelCode,
				'type' => $modelCode,
				'id' => $documentId
			]
		);


		//

		$result = $document['_source'];


		return $result;
	}


	/**
	 *
	 */

	public function indexDocument($indexCode, $indexType, $document, $documentId = null)
	{
		// Build the index arguments

		$arguments =
		[
			'index' => $indexCode,
			'type' => $indexType,
			'body' => $document
		];


		// Add the document ID

		if (empty($documentId) === false)
		{
			$arguments['id'] = $documentId;
		}


		// Index

		\z\service('driver/db/es')->index($arguments);
	}
}

?>
