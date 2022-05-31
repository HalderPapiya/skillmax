<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $table = 'mentors';

    protected $fillable = [
        'name', 'status'
    ];
    // public function course()
    // {
    //     $this->HasMany('App\Models\Course', 'mentorId', 'id');
    // }
}