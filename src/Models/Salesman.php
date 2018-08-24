<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'hire_date',
    ];
}
