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

	public function is01Relation($property)
	{
		if
		(
			($this->isRelation($property) === true) &&
			(array_key_exists('cardinality', $property) === true) &&
			(
				($property['cardinality'] === '0_1') ||
				($property['cardinality'] === '1_1')
			)
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

	public function is0NRelation($property)
	{
		if
		(
			($this->isRelation($property) === true) &&
			(array_key_exists('cardinality', $property) === true) &&
			(
				($property['cardinality'] === '0_n') ||
				($property['cardinality'] === '1_n')
			)
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

	public function isPivotRelation($property)
	{
		if
		(
			($this->is0NRelation($property) === true) &&
			(array_key_exists('pivot', $property) === true) &&
			(empty($property['pivot']) === false)
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
		if
		(
			(array_key_exists('model', $property) === true) &&
			(empty($property['model']) === false)
		)
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
