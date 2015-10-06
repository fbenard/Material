<?php

// Namespace

namespace fbenard\Material\Services\Queries;


/**
 *
 */

class DeleteQuery
extends \fbenard\Material\Classes\AbstractQuery
{
	// Attributes

	protected $_from = null;
	protected $_where = null;


	/**
	 *
	 */

	public function __construct()
	{
		// Call parent constructor

		parent::__construct();


		// Build attributes

		$this->_where = [];
	}


	/**
	 *
	 */

	public function andWhere($where)
	{
		// Store where

		$this->_where[] = func_get_args();
		

		return $this;
	}


	/**
	 *
	 */

	public function from($from)
	{
		// Store from

		$this->_from = $from;
		

		return $this;
	}


	/**
	 *
	 */

	public function where($where)
	{
		// Store where

		$this->_where[] = func_get_args();
		

		return $this;
	}
}

?>
