<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProCourse extends Model
{
    protected $table = 'pro_courses';

    protected $fillable = [
      'category_id' , 'name', 'mentor', 'image', 'description', 'status'
    ];

    public function module()
    {
        return $this->hasMany('App\Models\Module', 'course_id', 'id');
    }
}