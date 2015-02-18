<?php

// Namespace

namespace fbenard\Material\Services\Queries;


/**
 *
 */

class DropQuery
extends \fbenard\Material\Classes\AbstractQuery
{
	// Attributes

	protected $_tableCode = null;


	/**
	 *
	 */

	public function table($tableCode)
	{
		// Store the table code

		$this->_tableCode = $tableCode;


		return $this;
	}
}

?>
