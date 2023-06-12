<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];

    public function getFeaturedAttribute()
    {
        $value = $this->attributes['featured'];
        return $value == 1 ? true : false;
    }

    public function getOnSaleAttribute()
    {
        $value = $this->attributes['on_sale'];
        return $value == 1 ? true : false;
    }
}
