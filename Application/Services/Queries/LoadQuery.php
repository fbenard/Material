<?php

// Namespace

namespace fbenard\Material\Services\Queries;


/**
 *
 */

class LoadQuery
extends \fbenard\Material\Classes\AbstractQuery
{
	// Attributes

	protected $_isLocal = null;
	protected $_pathToFile = null;
	protected $_tableCode = null;


	/**
	 *
	 */

	public function infile($pathToFile)
	{
		// Store path to file

		$this->_pathToFile = $pathToFile;


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

	public function local()
	{
		// Load locally

		$this->_isLocal = true;
		

		return $this;
	}
}

?>
