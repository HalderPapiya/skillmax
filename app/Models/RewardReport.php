<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RewardReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reward_reports';

    protected $fillable = [
        'userId', 'time', 'amount', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'userId', 'id');
    }
}