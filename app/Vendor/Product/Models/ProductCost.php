<?php

namespace App\Vendor\Product\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DB\Management\Supplier;

class ProductCost extends Model
{
    protected $table = 't_products_costs';
    protected $guarded = [];  


    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id_supplier');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id_product');
    }
}
