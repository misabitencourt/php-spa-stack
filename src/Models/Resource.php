<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function permissions()
    {
        return $this->hasMany('App\Models\Permission', 'resource_id', 'id');
    }
}
