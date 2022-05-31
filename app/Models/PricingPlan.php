<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class PricingPlan extends Model
{
	// use SoftDeletes; 

	protected $table = 'pricing_plans';

	protected $fillable = [
		'name', 'short_description', 'amount'
		// , 'status'
	];
	// public function course()
	// {
	// 	$this->HasMany('App\Models\Course', 'pricingPlanId', 'id');
	// }
}