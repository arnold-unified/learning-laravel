<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'mobile', 'address'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFirstNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getLastNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
