<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'id',
        'email',
        'name',
    ];

    public function products(){
        return $this->hasMany('App\Product');
    }
}
