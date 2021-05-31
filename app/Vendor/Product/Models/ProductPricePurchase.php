<?php

namespace App\Vendor\Product\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPricePurchase extends Model
{
    protected $table = 't_products_prices_purchases';
    protected $guarded = [];  


    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
