<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMentor extends Model
{
    public function courseDetails()
    {
        return $this->belongsTo('App/Models/Course', 'courseId', 'id');
    }
    public function mentorDetails()
    {
        return $this->belongsTo('App\Models\Mentor', 'mentorId', 'id');
    }
}