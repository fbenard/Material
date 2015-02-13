<?php

// Namespace

namespace fbenard\Material\Services\Factories;


/**
 *
 */

class QueryFactory
{
	/**
	 *
	 */

	public function create()
	{
		return new \fbenard\Material\Classes\CreateQuery();
	}


	/**
	 *
	 */

	public function delete()
	{
		return new \fbenard\Material\Classes\DeleteQuery();
	}


	/**
	 *
	 */

	public function drop()
	{
		return new \fbenard\Material\Classes\DropQuery();
	}


	/**
	 *
	 */

	public function insert()
	{
		return new \fbenard\Material\Classes\InsertQuery();
	}


	/**
	 *
	 */

	public function select()
	{
		return new \fbenard\Material\Classes\SelectQuery();
	}


	/**
	 *
	 */

	public function update()
	{
		return new \fbenard\Material\Classes\UpdateQuery();
	}


	/**
	 *
	 */

	public function upsert()
	{
		return new \fbenard\Material\Classes\UpsertQuery();
	}
}

?>
