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
	protected $_properties = null;


	/**
	 *
	 */

	public function __construct($sender, $object, $properties = null)
	{
		// Cal the parent constructor

		parent::__construct($sender);


		// Store attributes

		$this->_object = $object;
		$this->_properties = $properties;
	}
}

?>
