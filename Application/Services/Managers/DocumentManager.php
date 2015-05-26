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
		// Get the full document

		$document = \z\service('driver/db/es')->get
		(
			[
				'index' => $modelCode,
				'type' => $modelCode,
				'id' => $documentId
			]
		);


		// Extract the document

		$result = $document['_source'];


		return $result;
	}


	/**
	 *
	 */

	public function indexDocument($indexCode, $indexType, $document, $documentId = null)
	{
		// Build arguments

		$arguments =
		[
			'index' => $indexCode,
			'type' => $indexType,
			'body' => $document
		];


		// Add the document ID to arguments

		if (empty($documentId) === false)
		{
			$arguments['id'] = $documentId;
		}


		// Index the document

		\z\service('driver/db/es')->index($arguments);
	}
}

?>
