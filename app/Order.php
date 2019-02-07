<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'status',
        'client_email',
        'partner_id',
        'delivery_dt'
    ];

    public function products(){
        return $this->belongsToMany('App\Product', 'order_products', 'order_id', 'product_id')
            ->withPivot('quantity');
    }

    public function partner(){
        return $this->hasOne('App\Partner', 'id', 'partner_id');
    }

    public function price(){
        $total_amount = 0;
    }
}
