<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuizAnswer extends Model
{
    protected $table = 'user_quiz_answers';

    protected $fillable = [
        'user_id', 'quiz_id', 'quiz_question_id', 'answer'
    ];

}