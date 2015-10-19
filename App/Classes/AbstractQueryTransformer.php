<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

abstract class AbstractQueryTransformer
{
	/**
	 *
	 */

	abstract public function transform($query, $connection);


	/**
	 *
	 */

	protected function buildResult($result, $separator = ' ')
	{
		// Ensure result is an array

		if (is_array($result) === false)
		{
			$result = [];
		}


		// Remove empty items from the result

		foreach ($result as $key => &$value)
		{
			if (is_null($value) === true)
			{
				unset($result[$key]);
			}
		}


		// Convert result into a string

		$result = implode($separator, $result);


		return $result;
	}
}

?>
