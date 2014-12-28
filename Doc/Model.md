## Abstract model

\z\service('manager/data')->connect();

$campaign = new \Greenbys\Models\Campaign();
$campaign->load(12);
$campaign->load(['name'=>'Christmas 2014']);
$campaign->name = 'Halloween 2015';
$campaign->find();
$campaign->save();
$campaign->saveAs();


```php
class Campaign
extends \Material\Classes\AbstractModel
{
	protected $_table;
	protected $_schema =
	[
		'name' => 
	];
	::where
	$model = User::where('votes', '>', 100)->firstOrFail();
	$users = User::where('votes', '>', 100)->take(10)->get();
	User::where('votes', '>', 100)->count();
	User::whereRaw('age > ? and votes = 100', array(25))->get();

User::chunk(200, function($users)
{
    foreach ($users as $user)
    {
        //
    }
});

User::on('connection-name')->find(1);
protected $fillable = array('first_name', 'last_name', 'email');
protected $guarded = array('id', 'password');
protected $guarded = array('*');

// Create a new user in the database...
$user = User::create(array('name' => 'John'));

// Retrieve the user by the attributes, or create it if it doesn't exist...
$user = User::firstOrCreate(array('name' => 'John'));

// Retrieve the user by the attributes, or instantiate a new instance...
$user = User::firstOrNew(array('name' => 'John'));

$user->push();
$affectedRows = User::where('votes', '>', 100)->update(array('status' => 2));

$user = User::find(1);

$user->delete();

User::destroy(1);
User::destroy(array(1, 2, 3));
User::destroy(1, 2, 3);

$affectedRows = User::where('votes', '>', 100)->delete();

$user->touch();

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

$users = User::withTrashed()->where('account_id', 1)->get();
$user->posts()->withTrashed()->get();
$users = User::onlyTrashed()->where('account_id', 1)->get();
$user->restore();
User::withTrashed()->where('account_id', 1)->restore();
$user->posts()->restore();
$user->forceDelete();
$user->posts()->forceDelete();
if ($user->trashed())

    public function scopePopular($query)
    {
        return $query->where('votes', '>', 100);
    }

    public function scopeWomen($query)
    {
        return $query->whereGender('W');
    }


$users = User::popular()->women()->orderBy('created_at')->get();

    public function scopeOfType($query, $type)
    {
        return $query->whereType($type);
    }


class User extends Eloquent {

    public function phone()
    {
        return $this->hasOne('Phone');
    }

}

$phone = User::find(1)->phone;

return $this->hasOne('Phone', 'foreign_key');

return $this->hasOne('Phone', 'foreign_key', 'local_key');


class Phone extends Eloquent {

    public function user()
    {
        return $this->belongsTo('User');
    }

}

class Phone extends Eloquent {

    public function user()
    {
        return $this->belongsTo('User', 'local_key');
    }

}

class Phone extends Eloquent {

    public function user()
    {
        return $this->belongsTo('User', 'local_key', 'parent_key');
    }

}

class Post extends Eloquent {

    public function comments()
    {
        return $this->hasMany('Comment');
    }

}

$comments = Post::find(1)->comments;

$comments = Post::find(1)->comments()->where('title', '=', 'foo')->first();

return $this->hasMany('Comment', 'foreign_key');

return $this->hasMany('Comment', 'foreign_key', 'local_key');

class Comment extends Eloquent {

    public function post()
    {
        return $this->belongsTo('Post');
    }

}

class User extends Eloquent {

    public function roles()
    {
        return $this->belongsToMany('Role');
    }

}

$roles = User::find(1)->roles;
return $this->belongsToMany('Role', 'user_roles');
return $this->belongsToMany('Role', 'user_roles', 'user_id', 'foo_id');

class Role extends Eloquent {

    public function users()
    {
        return $this->belongsToMany('User');
    }

}


class Country extends Eloquent {

    public function posts()
    {
        return $this->hasManyThrough('Post', 'User');
    }

}

class Country extends Eloquent {

    public function posts()
    {
        return $this->hasManyThrough('Post', 'User', 'country_id', 'user_id');
    }

}



class Photo extends Eloquent {

    public function imageable()
    {
        return $this->morphTo();
    }

}

class Staff extends Eloquent {

    public function photos()
    {
        return $this->morphMany('Photo', 'imageable');
    }

}

class Order extends Eloquent {

    public function photos()
    {
        return $this->morphMany('Photo', 'imageable');
    }

}

$staff = Staff::find(1);

foreach ($staff->photos as $photo)
{
    //
}

$photo = Photo::find(1);

$imageable = $photo->imageable;





class Post extends Eloquent {

    public function tags()
    {
        return $this->morphToMany('Tag', 'taggable');
    }

}


class Tag extends Eloquent {

    public function posts()
    {
        return $this->morphedByMany('Post', 'taggable');
    }

    public function videos()
    {
        return $this->morphedByMany('Video', 'taggable');
    }

}




$posts = Post::has('comments')->get();
$posts = Post::has('comments', '>=', 3)->get();

$posts = Post::whereHas('comments', function($q)
{
    $q->where('content', 'like', 'foo%');

})->get();




class Phone extends Eloquent {

    public function user()
    {
        return $this->belongsTo('User');
    }

}

$phone = Phone::find(1);

echo $phone->user->email;



foreach (Book::with('author')->get() as $book)
{
    echo $book->author->name;
}

$books = Book::with('author', 'publisher')->get();
$books = Book::with('author.contacts')->get();

$users = User::with(array('posts' => function($query)
{
    $query->where('title', 'like', '%first%');

}))->get();

$users = User::with(array('posts' => function($query)
{
    $query->orderBy('created_at', 'desc');

}))->get();

$books = Book::all();

$books->load('author', 'publisher');




$comment = new Comment(array('message' => 'A new comment.'));

$post = Post::find(1);

$comment = $post->comments()->save($comment);




$comments = array(
    new Comment(array('message' => 'A new comment.')),
    new Comment(array('message' => 'Another comment.')),
    new Comment(array('message' => 'The latest comment.'))
);

$post = Post::find(1);

$post->comments()->saveMany($comments);






$account = Account::find(10);
$user->account()->associate($account);
$user->save();


$user = User::find(1);
$user->roles()->attach(1);


$user->roles()->attach(1, array('expires' => $expires));
$user->roles()->detach(1);
$user = User::find(1);


$user->roles()->detach([1, 2, 3]);
$user->roles()->attach([1 => ['attribute1' => 'value1'], 2, 3]);


$user->roles()->sync(array(1, 2, 3));
$user->roles()->sync(array(1 => array('expires' => true)));


$role = new Role(array('name' => 'Editor'));
User::find(1)->roles()->save($role);
User::find(1)->roles()->save($role, array('expires' => $expires));



$user = User::find(1);

foreach ($user->roles as $role)
{
    echo $role->pivot->created_at;
}


return $this->belongsToMany('Role')->withPivot('foo', 'bar');



User::find(1)->roles()->detach();
User::find(1)->roles()->updateExistingPivot($roleId, $attributes);


public function newPivot(Model $parent, array $attributes, $table, $exists)
{
    return new YourCustomPivot($parent, $attributes, $table, $exists);
}




$roles = User::find(1)->roles;

if ($roles->contains(2))
{
    //
}




$roles = User::find(1)->roles->toArray();

$roles = User::find(1)->roles->toJson();

$roles = (string) User::find(1)->roles;



$roles = $user->roles->each(function($role)
{
    //
});

$users = $users->filter(function($user)
{
    return $user->isAdmin();
});

$roles = User::find(1)->roles;

$roles->each(function($role)
{
    //
});


$roles = $roles->sortBy(function($role)
{
    return $role->created_at;
});

$roles = $roles->sortBy('created_at');


    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }


    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value);
    }


