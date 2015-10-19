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
			(isset($property['localized']) === true) &&
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
