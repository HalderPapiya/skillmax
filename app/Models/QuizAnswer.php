<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $table = 'quiz_answers';

    protected $fillable = [
        'quiz_id', 'answer', 'hint', 'status'
    ];

    public function quiz()
    {

        return $this->belongsTo('App\Models\Quiz', 'quiz_id', 'id');
    }
}