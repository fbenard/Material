## Migrations and seeding

php artisan migrate:make create_users_table
php artisan migrate:make foo --path=app/migrations
php artisan migrate:make add_votes_to_user_table --table=users
php artisan migrate:make create_users_table --create=users
php artisan migrate
php artisan migrate --path=app/foo/migrations
php artisan migrate --package=vendor/package
php artisan migrate --force
php artisan migrate:rollback
php artisan migrate:reset
php artisan migrate:refresh
php artisan migrate:refresh --seed


class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('UserTableSeeder');

        $this->command->info('User table seeded!');
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array('email' => 'foo@bar.com'));
    }

}

php artisan db:seed
php artisan db:seed --class=UserTableSeeder
php artisan migrate:refresh --seed



Models have no shema. Instead, it is necessary to create migrations of the data model.

```
app material.createMigration
```

```php
class Migration
{
	public function migrate_0000()
	{
		$table = $this->createTable('campaigns');

		$table->addColumn
		(
			'id',
			self::TYPE_INTEGER,
			[
				self::OPTION_PRIMARY_KEY,
				self::OPTION_AUTO_INC
			]
		);
	}

	public function migrate_0001()
	{
		$table = $this->getTable('campaigns');

		$table->addColumn
		(
			'namee',
			self::TYPE_STRING,
			[
			]
		);
	}

	public function migrate_0001()
	{
		$table = $this->getTable('campaigns');

		$table->rename('campaign');

		$table->alterColumn
		(
			'namee',
			'name'
			self::TYPE_STRING,
			[
				self::OPTION_LOCALIZED
			]
		);
	}
}
```
