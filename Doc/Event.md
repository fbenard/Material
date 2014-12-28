## Events

``php
User::creating(function($user)
{
    if ( ! $user->isValid()) return false;
});


class User extends Eloquent {

    public static function boot()
    {
        parent::boot();

        // Setup event bindings...
    }

}

class UserObserver {

    public function saving($model)
    {
        //
    }

    public function saved($model)
    {
        //
    }

}

User::observe(new UserObserver);
```


**object**

- id

**object_event**

- id
- object_code
- object_id
- author_code
- author_id
- date
- type

**object_local**
