<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
      'id',
      'name',
      'price',
      'vendor_id'
    ];

    public function orders(){
        return $this->belongsToMany('App\Order', 'order_products', 'product_id', 'order_id');
    }

    public function vendor(){
        return $this->belongsTo('App\Vendor');
    }


}
