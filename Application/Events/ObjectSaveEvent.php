<?php

// Namespace

namespace fbenard\Material\Events;


/**
 *
 */

class ObjectSaveEvent
extends \fbenard\Zero\Classes\AbstractEvent
{
	// Attributes

	protected $_object = null;


	/**
	 *
	 */

	public function __construct($sender, $object)
	{
		// Cal the parent constructor

		parent::__construct($sender);


		// Store attributes

		$this->_object = $object;
	}
}

?>
