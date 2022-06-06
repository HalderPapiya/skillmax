<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'user_id', 'start_date', 'end_date', 'reason', 'status'
    ];
    public function user() 
    {

        return $this->belongsTo('App\Models\Uers', 'user_id', 'id');
    }
}