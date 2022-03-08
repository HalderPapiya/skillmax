<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use SoftDeletes;

    protected $table = 'forums';

    protected $fillable = [
        'userId', 'title', 'content', 'no_of_likes', 'no_of_comment', 'content', 'image', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'userId', 'id');
    }
    public function forumComment()
    {
        return $this->hasMany('App\Models\User', 'forumId', 'id');
    }
}