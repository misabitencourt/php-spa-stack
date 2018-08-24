<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public static $OLD_SALESMAN_COMISSION = 30;
    protected $fillable = [
        'salesman_id',
        'customer_id',
        'status',
        'obs',
    ];
    
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function salesman()
    {
        return $this->belongsTo('App\Models\Salesman');
    }
}
