<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

class CreateQuery
extends \fbenard\Material\Classes\AbstractQuery
{
	// Attributes

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
