<?php

namespace App\Vendor\Product\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $table = 't_products_stocks';

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
