<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interest extends Model
{
	use SoftDeletes;

	protected $table = 'interests';

	protected $fillable = [
		'name', 'description', 'image', 'status'
	];
	public function relationUserInterests()
	{
		$this->HasMany('App\Models\UserInterest', 'interestId', 'id');
	}
}