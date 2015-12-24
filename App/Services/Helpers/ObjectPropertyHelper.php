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

	public function isLocalized($property)
	{
		if
		(
			(array_key_exists('localized', $property) === true) &&
			($property['localized'] === true)
		)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	/**
	 *
	 */

	public function isRelation($property)
	{
		if (empty($property['model']) === false)
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
