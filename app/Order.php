<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $guarded = [];

    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function order_details(){
        return $this->hasMany('App\OrderDetail', 'order_id');
    }


}
