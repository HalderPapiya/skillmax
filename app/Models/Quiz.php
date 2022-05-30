<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $fillable = [
        'question', 'answer', 'image', 'status'
    ];

    public function module()
    {

        return $this->belongsTo('App\Models\Module', 'module_id', 'id');
    }

    public function quizAnswer()
    {

        return $this->belongsTo('App\Models\QuizAnswer', 'quiz_id', 'id');
    }
}