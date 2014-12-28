## Query builder

$results = DB::select('select * from users where id = ?', array(1));
DB::insert('insert into users (id, name) values (?, ?)', array(1, 'Dayle'));
DB::update('update users set votes = 100 where name = ?', array('John'));
DB::delete('delete from users');
DB::statement('drop table users');

DB::listen(function($sql, $bindings, $time)
{
    //
});


DB::transaction(function()
{
    DB::table('users')->update(array('votes' => 1));

    DB::table('posts')->delete();
});

DB::beginTransaction();
DB::rollback();
DB::commit();

$users = DB::connection('foo')->select(...);
$pdo = DB::connection()->getPdo();
DB::reconnect('foo');
DB::disconnect('foo');
DB::connection()->disableQueryLog();
$queries = DB::getQueryLog();


$users = DB::table('users')->get();
foreach ($users as $user)
{
    var_dump($user->name);
}


$user = DB::table('users')->where('name', 'John')->first();
var_dump($user->name);


$name = DB::table('users')->where('name', 'John')->pluck('name');


$roles = DB::table('roles')->lists('title');


$roles = DB::table('roles')->lists('title', 'name');


$users = DB::table('users')->select('name', 'email')->get();
$users = DB::table('users')->distinct()->get();
$users = DB::table('users')->select('name as user_name')->get();


$query = DB::table('users')->select('name');
$users = $query->addSelect('age')->get();


$users = DB::table('users')->where('votes', '>', 100)->get();


$users = DB::table('users')
                    ->where('votes', '>', 100)
                    ->orWhere('name', 'John')
                    ->get();


$users = DB::table('users')
                    ->whereBetween('votes', array(1, 100))->get();


$users = DB::table('users')
                    ->whereNotBetween('votes', array(1, 100))->get();


$users = DB::table('users')
                    ->whereIn('id', array(1, 2, 3))->get();

$users = DB::table('users')
                    ->whereNotIn('id', array(1, 2, 3))->get();


$users = DB::table('users')
                    ->whereNull('updated_at')->get();

$users = DB::table('users')
                    ->orderBy('name', 'desc')
                    ->groupBy('count')
                    ->having('count', '>', 100)
                    ->get();

$users = DB::table('users')->skip(10)->take(5)->get();

DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.id', 'contacts.phone', 'orders.price')
            ->get();


DB::table('users')
        ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
        ->get();


DB::table('users')
        ->join('contacts', function($join)
        {
            $join->on('users.id', '=', 'contacts.user_id')->orOn(...);
        })
        ->get();


DB::table('users')
        ->join('contacts', function($join)
        {
            $join->on('users.id', '=', 'contacts.user_id')
                 ->where('contacts.user_id', '>', 5);
        })
        ->get();


DB::table('users')
            ->where('name', '=', 'John')
            ->orWhere(function($query)
            {
                $query->where('votes', '>', 100)
                      ->where('title', '<>', 'Admin');
            })
            ->get();



DB::table('users')
            ->whereExists(function($query)
            {
                $query->select(DB::raw(1))
                      ->from('orders')
                      ->whereRaw('orders.user_id = users.id');
            })
            ->get();




$users = DB::table('users')->count();

$price = DB::table('orders')->max('price');

$price = DB::table('orders')->min('price');

$price = DB::table('orders')->avg('price');

$total = DB::table('users')->sum('votes');


$users = DB::table('users')
                     ->select(DB::raw('count(*) as user_count, status'))
                     ->where('status', '<>', 1)
                     ->groupBy('status')
                     ->get();



DB::table('users')->insert(
    array('email' => 'john@example.com', 'votes' => 0)
);


$id = DB::table('users')->insertGetId(
    array('email' => 'john@example.com', 'votes' => 0)
);

DB::table('users')->insert(array(
    array('email' => 'taylor@example.com', 'votes' => 0),
    array('email' => 'dayle@example.com', 'votes' => 0),
));

DB::table('users')
            ->where('id', 1)
            ->update(array('votes' => 1));


DB::table('users')->increment('votes');

DB::table('users')->increment('votes', 5);

DB::table('users')->decrement('votes');

DB::table('users')->decrement('votes', 5);


DB::table('users')->increment('votes', 1, array('name' => 'John'));



DB::table('users')->where('votes', '<', 100)->delete();

DB::table('users')->delete();
DB::table('users')->truncate();

$first = DB::table('users')->whereNull('first_name');

$users = DB::table('users')->whereNull('last_name')->union($first)->get();


DB::table('users')->where('votes', '>', 100)->sharedLock()->get();
DB::table('users')->where('votes', '>', 100)->lockForUpdate()->get();


$users = DB::table('users')->remember(10)->get();
$users = DB::table('users')->cacheTags(array('people', 'authors'))->remember(10)->get();




```php
$query = \z\service('manager/data')->query();
$query->
```
