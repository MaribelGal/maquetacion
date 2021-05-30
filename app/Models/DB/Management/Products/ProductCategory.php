<?php

namespace App\Models\DB\Management\Products;

use app\Models\DB\DBModel;
use app\Vendor\Product\Models\Product;

class ProductCategory extends DBModel
{

    protected $table = 't_products_categories';

    public function products()
    {
        return $this->hasMany(Product::class, 'id_product_category');
    }
} 
