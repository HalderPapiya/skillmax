<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    // use SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'pricingPlanId', 'name', 'image', 'description', 'start_date', 'mentorId'
    ];

    public function pricingPlan()
    {
        return $this->belongsTo('App\Models\PricingPlan', 'pricingPlanId', 'id');
    }
    public function mentor()
    {
        return $this->belongsTo('App\Models\Mentor', 'mentorId', 'id');
    }
}