<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuiz extends Model
{
    protected $table = 'user_quizzes';

    protected $fillable = [
        'user_id', 'quiz_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App/Models/User', 'user_id', 'id');
    }
    public function quizQuestion()
    {
        return $this->belongsTo('App\Models\QuizQuestion', 'quiz_question_id', 'id');
    }
}