<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public function orders(){
        return $this->belongsToMany(Order::class,'order_detail', 'product_id', 'order_id') ;
        }

        public function orderDetail(){
        return $this->hasMany(DetailOrder::class,'product_id');

        }
}

