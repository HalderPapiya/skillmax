<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $table = 'mentors';

    protected $fillable = [
        'courseId', 'name', 'status'
    ];
    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'courseId', 'id');
    }
}