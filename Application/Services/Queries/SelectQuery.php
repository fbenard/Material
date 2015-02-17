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


	/**
	 *
	 */

	public function __construct()
	{
		parent::__construct('select');
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
}

?>
