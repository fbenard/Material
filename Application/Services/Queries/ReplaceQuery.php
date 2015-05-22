<?php

// Namespace

namespace fbenard\Material\Services\Queries;


/**
 *
 */

class ReplaceQuery
extends \fbenard\Material\Classes\AbstractQuery
{
	// Attributes

	protected $_columns = null;
	protected $_tableCode = null;
	protected $_values = null;


	/**
	 *
	 */

	public function columns($columns)
	{
		// Store columns

		$this->_columns = $columns;


		return $this;
	}


	/**
	 *
	 */

	public function into($tableCode)
	{
		// Store table code

		$this->_tableCode = $tableCode;
		

		return $this;
	}


	/**
	 *
	 */

	public function values($values)
	{
		// Store values

		$this->_values = $values;
		

		return $this;
	}
}

?>
