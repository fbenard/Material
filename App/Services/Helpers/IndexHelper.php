<?php

// Namespace

namespace fbenard\Material\Services\Helpers;


/**
 *
 */

class IndexHelper
{
	/**
	 *
	 */

	public function fixQuery($modelCode, $query)
	{
		// Store final query

		$result = $query;


		// Empty query means everything

		if (empty($result) === true)
		{
			$result = '*';
		}

		
		// Get alias for the model

		$alias = \z\pref('search/' . $modelCode . '/alias');

		if (is_array($alias) === true)
		{
			$result = str_replace
			(
				array_keys($alias),
				array_values($alias),
				$result
			);
		}


		// Adds support for ! as IS NULL

		$result = str_replace('!', '_missing_:', $result);


		return $result;
	}


	/**
	 *
	 */

	public function fixOrder($modelCode, $order)
	{
		// Make sure $order is an array

		if (is_array($order) === false)
		{
			$order = [];
		}


		// Use default ordering if none defined

		if (empty($order) === true)
		{
			// Get order for the model

			$order = \z\pref('search/' . $modelCode . '/order');

			if (is_array($order) === false)
			{
				$order =
				[
					'date_created' => 'desc'
				];
			}
		}


		// Build the final sort array

		$result = [];

		foreach ($order as $key => $direction)
		{
			$result[] =
			[
				$key =>
				[
					'order' => $direction
				]
			];
		}


		return $result;
	}
}

?>
