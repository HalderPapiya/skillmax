<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursePricingPlan extends Model
{
    public function courseDetails()
    {
        return $this->belongsTo('App\Models\Course', 'courseId', 'id');
    }
    public function pricingDetails()
    {
        return $this->belongsTo('App\Models\PricingPlan', 'pricingPlanId', 'id');
    }
}