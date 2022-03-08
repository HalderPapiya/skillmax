<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reword extends Model
{
    use HasFactory,SoftDeletes;

     protected $table = 'rewords';

	protected $fillable = [
	   'time', 'amount', 'status'
	];
}
