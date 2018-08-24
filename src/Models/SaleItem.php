<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
        'product_id',
        'sale_id',
        'qt',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
