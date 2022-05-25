<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProCourse extends Model
{
    protected $table = 'pro_courses';

    protected $fillable = [
        'name', 'mentor', 'image', 'description', 'status'
    ];
}