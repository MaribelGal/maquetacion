<?php

namespace App\Vendor\Product\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPriceRent extends Model
{
    protected $table = 't_products_prices_rents';
    protected $guarded = [];  

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
