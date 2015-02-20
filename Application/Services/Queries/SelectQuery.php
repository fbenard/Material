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

	protected $_count = null;
	protected $_fields = null;
	protected $_from = null;
	protected $_groupBy = null;
	protected $_isDistinct = null;
	protected $_limit = null;
	protected $_offset = null;
	protected $_where = null;


	/**
	 *
	 */

	public function __construct()
	{
		// Call parent constructor

		parent::__construct();


		// Build attributes

		$this->_count = [];
		$this->_fields = [];
		$this->_groupBy = [];
		$this->_orderBy = [];
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

	public function count($fieldCode, $alias = null)
	{
		// Store field

		$this->_count[$fieldCode] = $alias;
		

		return $this;
	}


	/**
	 *
	 */

	public function distinct()
	{
		// Store field

		$this->_isDistinct = true;
		

		return $this;
	}


	/**
	 *
	 */

	public function fields($fields)
	{
		// Store fields

		$this->_fields = $fields;
		

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

	public function groupBy($groupBy)
	{
		// Store groupBy

		$this->_groupBy = $groupBy;
		

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

	public function orderBy($orderBy)
	{
		// Store orderBy

		$this->_orderBy = $orderBy;
		

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
