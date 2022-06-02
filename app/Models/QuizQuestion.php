<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $table = 'quiz_questions';

    protected $fillable = [
       'module_id', 'question', 'hint', 'path', 'hint_image', 'hint_image_path', 'position',
        'image', 'status'
    ];

    public function module()
    {

        return $this->belongsTo('App\Models\Module', 'module_id', 'id');
    }
    public function quiz()
    {

        return $this->belongsTo('App\Models\Quiz', 'quiz_id', 'id');
    }

    public function quizAnswer()
    {

        return $this->hasMany('App\Models\QuizAnswer', 'question_id', 'id');
    }
}  