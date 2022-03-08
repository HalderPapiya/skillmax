<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'title', 'start_date', 'end_date', 'email', 'phone', 'website', 'address', 'price', 'registration_link', 'description', 'image', 'status'
    ];
}