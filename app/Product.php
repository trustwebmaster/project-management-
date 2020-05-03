<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{  
    protected $fillable =[
    'product_name',
    'quantity',
    'date',
    ];

    public function used() {
        return $this->hasMany('\App\StockUsed');
    }
}
