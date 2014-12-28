## Schema

Schema::create('users', function($table)
{
    $table->increments('id');
});

Schema::rename($from, $to);

Schema::connection('foo')->create('users', function($table)
{
    $table->increments('id');
});

Schema::drop('users');

Schema::dropIfExists('users');

Schema::table('users', function($table)
{
    $table->string('email');
});

Schema::table('users', function($table)
{
    $table->string('email');
});

$table->bigIncrements('id');	Incrementing ID using a "big integer" equivalent.
$table->bigInteger('votes');	BIGINT equivalent to the table
$table->binary('data');	BLOB equivalent to the table
$table->boolean('confirmed');	BOOLEAN equivalent to the table
$table->char('name', 4);	CHAR equivalent with a length
$table->date('created_at');	DATE equivalent to the table
$table->dateTime('created_at');	DATETIME equivalent to the table
$table->decimal('amount', 5, 2);	DECIMAL equivalent with a precision and scale
$table->double('column', 15, 8);	DOUBLE equivalent with precision, 15 digits in total and 8 after the decimal point
$table->enum('choices', array('foo', 'bar'));	ENUM equivalent to the table
$table->float('amount');	FLOAT equivalent to the table
$table->increments('id');	Incrementing ID to the table (primary key).
$table->integer('votes');	INTEGER equivalent to the table
$table->longText('description');	LONGTEXT equivalent to the table
$table->mediumInteger('numbers');	MEDIUMINT equivalent to the table
$table->mediumText('description');	MEDIUMTEXT equivalent to the table
$table->morphs('taggable');	Adds INTEGER taggable_id and STRING taggable_type
$table->nullableTimestamps();	Same as timestamps(), except allows NULLs
$table->smallInteger('votes');	SMALLINT equivalent to the table
$table->tinyInteger('numbers');	TINYINT equivalent to the table
$table->softDeletes();	Adds deleted_at column for soft deletes
$table->string('email');	VARCHAR equivalent column
$table->string('name', 100);	VARCHAR equivalent with a length
$table->text('description');	TEXT equivalent to the table
$table->time('sunrise');	TIME equivalent to the table
$table->timestamp('added_on');	TIMESTAMP equivalent to the table
$table->timestamps();	Adds created_at and updated_at columns
$table->rememberToken();	Adds remember_token as VARCHAR(100) NULL
->nullable()	Designate that the column allows NULL values
->default($value)	Declare a default value for a column
->unsigned()	Set INTEGER to UNSIGNED

$table->string('name')->after('email');

Schema::table('users', function($table)
{
    $table->renameColumn('from', 'to');
});

Schema::table('users', function($table)
{
    $table->dropColumn('votes');
});

Schema::table('users', function($table)
{
    $table->dropColumn(array('votes', 'avatar', 'location'));
});

if (Schema::hasTable('users'))
{
    //
}

if (Schema::hasColumn('users', 'email'))
{
    //
}

$table->string('email')->unique();


$table->primary('id');	Adding a primary key
$table->primary(array('first', 'last'));	Adding composite keys
$table->unique('email');	Adding a unique index
$table->index('state');	Adding a basic index

$table->integer('user_id')->unsigned();
$table->foreign('user_id')->references('id')->on('users');

$table->foreign('user_id')
      ->references('id')->on('users')
      ->onDelete('cascade');

$table->dropForeign('posts_user_id_foreign');

$table->dropPrimary('users_id_primary');	Dropping a primary key from the "users" table
$table->dropUnique('users_email_unique');	Dropping a unique index from the "users" table
$table->dropIndex('geo_state_index');	Dropping a basic index from the "geo" table



	Description
$table->dropTimestamps();	Dropping the created_at and updated_at columns from the table
$table->dropSoftDeletes();	Dropping deleted_at column from the table


Schema::create('users', function($table)
{
    $table->engine = 'InnoDB';

    $table->string('email');
});
