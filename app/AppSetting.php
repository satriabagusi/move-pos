<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    //

    protected $guarded = [];

    // protected $table = 'app_settings';

    public static function checkDiscountFeatures(){
        $setting = AppSetting::select('discount_feature')->first();
        return $setting->discount_feature;
    }
}
