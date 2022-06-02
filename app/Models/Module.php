<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{

    protected $table = 'modules';

    protected $fillable = [
        'name', 'course_id', 'icon', 'status'
    ];
    public function proCourse()
    {

        return $this->belongsTo('App\Models\ProCourse', 'course_id', 'id');
    }
    public function topics()
    {

        return $this->hasMany('App\Models\Topic', 'module_id', 'id');
    }
    public function quizQuestions()
    {

        return $this->hasMany('App\Models\QuizQuestion', 'module_id', 'id');
    }
    public function quiz()
    {

        return $this->hasMany('App\Models\Quiz', 'module_id', 'id');
    }
}