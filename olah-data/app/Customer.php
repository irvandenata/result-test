<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
     public function orders(){
        return $this->hasMany(Order::class,'customer_id') ;
    }

    public function user (){
    return $this->hasOne(User::class,'id');
    }




}
