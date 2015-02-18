<?php

// Namespace

namespace fbenard\Material\Services\Queries;


/**
 *
 */

class SelectQuery
extends \fbenard\Material\Classes\AbstractQuery
{
	// Attributes

	protected $_from = null;
	protected $_limit = null;
	protected $_offset = null;
	protected $_where = null;


	/**
	 *
	 */

	public function __construct()
	{
		parent::__construct();
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

	public function limit($limit)
	{
		// Store limit

		$this->_limit = $limit;
		

		return $this;
	}


	/**
	 *
	 */

	public function offset($offset)
	{
		// Store offset

		$this->_offset = $offset;
		

		return $this;
	}


	/**
	 *
	 */

	public function where($where)
	{
		// Store where

		$this->_where = $where;
		

		return $this;
	}
}

?>
