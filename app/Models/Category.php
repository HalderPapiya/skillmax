<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'description'
    ];
    public function course()
    {
        return $this->hasMany('App\Models\ProCourse', 'category_id', 'id')->limit(4);
    }
}