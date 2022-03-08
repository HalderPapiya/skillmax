<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{

    protected $fillable = [
        'userId', 'forumId', 'content'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'userId', 'id');
    }
    public function forum()
    {
        return $this->belongsTo('App\Models\Forum', 'forumId', 'id');
    }
}