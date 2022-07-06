<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prime extends Model
{
   
    protected $table = 'primes';

    protected $fillable = [
        'user_id', 'start_date', 'end_date', 'status'
    ];
}