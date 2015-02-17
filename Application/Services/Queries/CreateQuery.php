<?php

// Namespace

namespace fbenard\Material\Services\Queries;


/**
 *
 */

class CreateQuery
extends \fbenard\Material\Classes\AbstractQuery
{
	// Attributes

	protected $_charset = null;
	protected $_engine = null;
	protected $_fields = null;
	protected $_table = null;


	/**
	 *
	 */

	public function __construct()
	{
		parent::__construct('create');
	}


	/**
	 *
	 */

	public function charset($charset)
	{
		// Store the charset

		$this->_charset = $charset;


		return $this;
	}


	/**
	 *
	 */

	public function engine($engine)
	{
		// Store the engine

		$this->_engine = $engine;


		return $this;
	}


	/**
	 *
	 */

	public function table($tableCode)
	{
		// Build the table

		$this->_table = new \fbenard\Material\Classes\Table($tableCode);


		return $this;
	}


	/**
	 *
	 */

	public function fields($callbacks)
	{
		// Apply each callback

		foreach ($callbacks as $callback)
		{
			$callback($this->_table);
		}


		return $this;
	}
}

?>
