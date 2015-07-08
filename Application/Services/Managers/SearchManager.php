<?php

// Namespace

namespace fbenard\Material\Services\Managers;


/**
 *
 */

class SearchManager
{
	/**
	 *
	 */

	public function downloadSearch($searchId)
	{
		// Get the search

		$search = json_decode(\z\service('driver/redis')->get($searchId));


		// Perform an all-search

		$result = call_user_func_array
		(
			[
				$this,
				'searchAll'
			],
			$search
		);


		// Convert the search to CSV

		$array = \z\service('converter/search')->convertToArray($result);
		$csv = \z\service('factory/csv')->convertToCsv($array);


		// Build the filename

		$filename = 'search_' . $searchId . '.csv';


		// Disable compression

		apache_setenv('no-gzip', 1);
		ini_set('zlib.output_compression', 'Off');


		// Set HTTP response headers

		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . stripslashes($filename) . '"');
		header('Pragma: public');
		header('Expires: -1');
		header('Cache-Control: public, must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private', false);

		print $csv;
		die();
	}


	/**
	 *
	 */

	public function search($modelCode, $query = null, $filters = null, $order = null, $group = null, $page = null, $pageSize = null)
	{
		// Store the search

		$searchId = $this->storeSearch(func_get_args());


		// http://www.elastic.co/guide/en/elasticsearch/client/php-api/current/_search_operations.html
		// http://www.elastic.co/guide/en/elasticsearch/reference/1.x/query-dsl-query-string-query.html

		// Fix arguments

		$query = \z\service('helper/index')->fixQuery($modelCode, $query);
		$order = \z\service('helper/index')->fixOrder($modelCode, $order);


		// Fix the page size

		if ($pageSize <= 0)
		{
			$pageSize = \z\pref('fbenard/material/page/size');
		}


		// Build the search input

		$input =
		[
			'index' => $modelCode,
			'body' =>
			[
				'query' =>
				[
					'query_string' =>
					[
						'default_operator' => 'and',
						'query' => $query
					]
				],
				'sort' => $order
			],
			'from' => $page * $pageSize,
			'size' => $pageSize
		];


		// Perform the search

		$output = \z\service('driver/db/es')->search($input);


		// Parse hits to build data

		$data = [];

		foreach ($output['hits']['hits'] as $hit)
		{
			$data[$hit['_id']] = $hit['_source'];
		}


		// Build the result

		$result =
		[
			'id' => $searchId,
			'size' => $output['hits']['total'],
			'range' =>
			[
				$input['from'],
				$input['size']
			],
			'data' => $data
		];


		return $result;
	}


	/**
	 *
	 */

	public function searchAll($modelCode, $query = null, $filters = null, $order = null, $group = null)
	{
		// Disable time/memory limit

		set_time_limit(0);
		ini_set('memory_limit', '-1');


		// Build result

		$result =
		[
			'id' => null,
			'size' => null,
			'range' => [],
			'data' => []
		];


		// Search all results

		$page = 0;

		do
		{
			// Perform the search

			$output = $this->search
			(
				$modelCode,
				$query,
				$filters,
				$order,
				$group,
				$page
			);


			// Build results

			$result =
			[
				'id' => $output['id'],
				'size' => $output['size'],
				'range' =>
				[
					0,
					$output['size']
				],
				'data' => array_merge
				(
					$result['data'],
					$output['data']
				)
			];


			// Move on to the next page

			$page++;
		}
		while (empty($output['data']) === false);


		return $result;
	}


	/**
	 *
	 */

	private function storeSearch($search)
	{
		//

		unset($search[5]);
		unset($search[6]);


		//

		$search = json_encode($search);
		$searchId = md5($search);


		// Store the search

		\z\service('driver/redis')->set($searchId, $search);


		return $searchId;
	}
}

?>
