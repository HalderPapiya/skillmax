<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{

    protected $table = 'topics';

    protected $fillable = [
        'title', 'module_id', 'image', 'description', 'extra_note' ,'status'
    ];
    public function module() 
    {

        return $this->belongsTo('App\Models\Module', 'module_id', 'id');
    }
}