<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Industry extends Model
{
    use SoftDeletes;

    protected $table = 'industries';

    protected $fillable = [
       'industry', 'status'
    ];
}