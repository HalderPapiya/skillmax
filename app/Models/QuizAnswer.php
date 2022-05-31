<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $table = 'quiz_answers';

    protected $fillable = [
        'module_id', 'question_id', 'answer', 'answer_image',
        'answer_image_path','position' ,'status'
    ];


    public function quizQuestion()
    {

        return $this->belongsTo('App\Models\QuizQuestion', 'question_id', 'id');
    }
}