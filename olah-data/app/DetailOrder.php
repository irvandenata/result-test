<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $table = 'order_detail';
    public function order (){
    return $this->belongsTo(Order::class,'order_id');
    }

    public function product (){
    return $this->belongsTo(Product::class,'product_id');

    }
}
