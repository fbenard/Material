<?php

// Namespace

namespace fbenard\Material\Classes;


/**
 *
 */

class Connection
{
	// Traits

	use \fbenard\Zero\Traits\GetTrait;
	use \fbenard\Zero\Traits\SetTrait;

	
	// Attributes

	private $_charset = null;
	private $_driver = null;
	private $_host = null;
	private $_login = null;
	private $_name = null;
	private $_password = null;
	private $_system = null;
}

?>
