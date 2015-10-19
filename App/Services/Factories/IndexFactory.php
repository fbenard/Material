<?php

// Namespace

namespace fbenard\Material\Services\Factories;


/**
 *
 */

class IndexFactory
{
	/**
	 *
	 */

	public function buildIndex($indexCode, $mapping = null)
	{
		// Make sure mapping is an array

		if (is_array($mapping) === false)
		{
			$mapping = [];
		}


		// Build the index

		$index =
		[
			'index' => $indexCode,
			'body' =>
			[
				'mappings' =>
				[
					$indexCode =>
					[
						'properties' => $mapping
					]
				]
			]
		];


		return $index;
	}
}

?>
