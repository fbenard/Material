<?php

// Namespace

namespace fbenard\Material\Services\Helpers;


/**
 *
 */

class ObjectPropertyHelper
{
	/**
	 *
	 */

	public function isRelation($property)
	{
		if (strpos($property['type'], 'model:') === 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

?>
