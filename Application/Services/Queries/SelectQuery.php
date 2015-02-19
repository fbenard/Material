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

	protected $_counts = null;
	protected $_distincts = null;
	protected $_fields = null;
	protected $_from = null;
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

		$this->_counts = [];
		$this->_distincts = [];
		$this->_fields = [];
	}


	/**
	 *
	 */

	public function count($fieldCode, $alias = null)
	{
		// Store field

		$this->_counts[$fieldCode] = $alias;
		

		return $this;
	}


	/**
	 *
	 */

	public function distinct($fieldCode, $alias = null)
	{
		// Store field

		$this->_distincts[] = $fieldCode;
		

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
