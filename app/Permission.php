<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Role;

class Permission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
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
