<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\User;
use App\Permission;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description'
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function getCreatedAttribute()
    {
        return $this->created_at->format(env('DATE_FORMAT'));
    }

    public function getUpdatedAttribute()
    {
        return Carbon::parse($this->updated_at)->format(env('DATE_FORMAT'));
    }
}
