<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    //

    public function products(){
        return $this->belongsTo('App\Product', 'product_id');
    }

    protected $guarded = [];
}
