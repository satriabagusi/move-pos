<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //

    protected $guarded = [];

    public function products(){
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function orders(){
        return $this->belongsTo('App\Order', 'order_id');
    }

}
