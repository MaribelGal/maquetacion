<?php

namespace App\Vendor\Product\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DB\Management\Products\ProductCategory;
use App\Models\DB\Management\Products\Shirt\Shirt;
use App\Models\DB\Management\Products\Shirt\ShirtTissue;
use App\Vendor\Product\Models\ProductCost;
use App\Vendor\Product\Models\ProductStock;
use App\Vendor\Product\Models\ProductPricePurchase;
use App\Vendor\Product\Models\ProductPriceRent;
use App\Vendor\Product\Models\ProductPriceModifier;


class Product extends Model
{
    protected $table = 't_products';
    protected $guarded = [];  


    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function tissues() {
        return $this->hasMany(ShirtTissue::class, 'product_id');

    }

    public function cost(){
        return $this->hasOne(ProductCost::class, 'product_id');
    }

    public function stock(){
        return $this->hasOne(ProductStock::class, 'product_id');
    }

    public function price_purchase(){
        return $this->hasOne(ProductPricePurchase::class, 'product_id');
    }

    public function price_rent(){
        return $this->hasOne(ProductPriceRent::class, 'product_id');
    }

    public function price_modifiers_purchase(){
        return $this->hasMany(ProductPriceModifier::class, 'product_id')->where('sale_method', 'purchase');
    }

    public function price_modifiers_rent(){
        return $this->hasMany(ProductPriceModifier::class, 'product_id')->where('sale_method', 'rent');
    }
}
