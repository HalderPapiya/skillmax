<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quiz_questions';

    protected $fillable = [
        'module_id', 'status'
    ];

    public function module()
    {

        return $this->belongsTo('App\Models\Module', 'module_id', 'id');
    }

    public function quizQuestion()
    {

        return $this->belongsTo('App\Models\QuizQuestion', 'quiz_id', 'id');
    }
}