<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = 'agent';
    public function orders (){
    return $this->hasMany(Order::class,'agent_id');
    }

}
