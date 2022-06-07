<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_detail', 'product_id', 'order_id');

    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
     public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function detailOrder()
    {
        return $this->hasOne(DetailOrder::class, 'order_id');
    }

}
