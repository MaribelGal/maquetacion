<?php

namespace App\Vendor\Product\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DB\Management\Products\ProductCategory;

class Product extends Model
{
    protected $table = 't_products';


    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'id_product_category');
    }
 
}
