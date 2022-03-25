<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{

    protected $table = 'user_interests';

    protected $fillable = [
        'userId', 'interestId'
    ];

    public function user()
    {
        return $this->belongsTo('App/Models/User', 'userId', 'id');
    }
    public function interestDetails()
    {
        return $this->belongsTo('App\Models\Interest', 'interestId', 'id');
    }
}