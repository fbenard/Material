<?php

// Namespace

namespace fbenard\Material\Services\Drivers;


/**
 *
 */

class ElasticSearchDriver
{
	// Attributes

	private $_client = null;


	/**
	 *
	 */

	public function __construct()
	{
		$this->_client = new \Elasticsearch\Client();
	}


	/**
	 *
	 */

	public function __call($methodCode, $methodArguments)
	{
		try
		{
			// Execute the method

			$result = call_user_func_array
			(
				[
					$this->_client,
					$methodCode
				],
				$methodArguments
			);


			return $result;
		}
		catch (\Exception $e)
		{
			\z\e
			(
				EXCEPTION_ES_METHOD_FAILED,
				[
					'methodCode' => $methodCode,
					'methodArguments' => $methodArguments,
					'error' => $e->getMessage()
				]
			);
		}
	}
}

?>
