<?php

// Namespace

namespace fbenard\Material\Services\Factories;


/**
 *
 */

class QueryFactory
{
	/**
	 *
	 */

	public function __call($methodCode, $methodArguments)
	{
		return \z\service('query/' . $methodCode, true);
	}
}

?>
