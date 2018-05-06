<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\User;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'content'
    ];

    protected $dates = [
        'published_at', 'deleted_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function moderator()
    {
        return $this->belongsTo(User::class, 'last_moderator_id');
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function getTitleAttribute($value)
    {
        return ucwords($value);
    }

    public function getPublishedAttribute()
    {
        if (!$this->published_at) {
            return null;
        }

        return Carbon::parse($this->published_at)->format(env('DATE_FORMAT'));
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
