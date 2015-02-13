<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

class InsertQuery
extends \fbenard\Material\Classes\AbstractQuery
{
	// Attributes

	protected $_columns = null;
	protected $_into = null;
	protected $_values = null;


	/**
	 *
	 */

	public function __construct()
	{
		parent::__construct('insert');
	}


	/**
	 *
	 */

	public function columns($columns)
	{
		return $this;
	}


	/**
	 *
	 */

	public function into($tableCode)
	{
		return $this;
	}


	/**
	 *
	 */

	public function values($values)
	{
		return $this;
	}
}

?>
