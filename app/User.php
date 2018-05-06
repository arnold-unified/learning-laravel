<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Profile;
use App\Role;
use App\UserPermissionView;
use App\Post;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->hasMany(UserPermissionView::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function moderated_posts()
    {
        return $this->hasMany(Post::class, 'last_moderator_id');
    }

    public function getCreatedAttribute()
    {
        return $this->created_at->format(env('DATE_FORMAT'));
    }

    public function getUpdatedAttribute()
    {
        return Carbon::parse($this->updated_at)->format(env('DATE_FORMAT'));
    }

    public function getRolesListAttribute()
    {
        return $this->roles->implode('name', ', ');
    }

    public function hasRole($roleName)
    {
        $thisRole = $this->roles->first(function ($role) use ($roleName) {
            return strtolower($roleName) == strtolower($role->name);
        });
        return $thisRole != null;
    }

    public function hasPermission($permissionName)
    {
        $thisPermission = $this->permissions->first(function ($permission) use ($permissionName) {
            return $permissionName == $permission->name;
        });
        return $thisPermission != null;
    }
}
