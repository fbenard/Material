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
		parent::__construct($sender);
		$this->_object = $object;
	}
}

?>
