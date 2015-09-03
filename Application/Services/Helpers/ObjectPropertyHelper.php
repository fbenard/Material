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
