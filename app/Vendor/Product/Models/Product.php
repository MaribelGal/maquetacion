<?php

namespace App\Vendor\Product\Models;

use App\Models\DB\DBModel;
use App\Models\DB\Management\Products\ProductCategory;
use App\Models\DB\Management\Products\Shirt\Shirt;
use App\Models\DB\Management\Products\Shirt\ShirtTissue;
use App\Vendor\Product\Models\ProductCost;
use App\Vendor\Product\Models\ProductStock;
use App\Vendor\Product\Models\ProductPricePurchase;
use App\Vendor\Product\Models\ProductPriceRent;
use App\Vendor\Product\Models\ProductPriceModifier;

use App\Vendor\Locale\Models\Locale;
use App\Vendor\Locale\Models\LocaleSlugSeo;
use App\Vendor\Image\Models\ImageResized;
use App;

class Product extends DBModel
{
    protected $table = 't_products';


    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id',);
    }


    public function cost()
    {
        return $this->hasOne(ProductCost::class, 'product_id');
    }

    public function stock()
    {
        return $this->hasOne(ProductStock::class, 'product_id');
    }

    public function price_purchase()
    {
        return $this->hasOne(ProductPricePurchase::class, 'product_id');
    }

    public function price_rent()
    {
        return $this->hasOne(ProductPriceRent::class, 'product_id');
    }

    public function price_modifiers_purchase()
    {
        return $this->hasMany(ProductPriceModifier::class, 'product_id')->where('sale_method', 'purchase');
    }

    public function price_modifiers_rent()
    {
        return $this->hasMany(ProductPriceModifier::class, 'product_id')->where('sale_method', 'rent');
    }



    public function locale()
    {
        return $this->hasMany(Locale::class, 'key')->where('rel_parent', 'products')->where('language', App::getLocale());
    }

    public function seo()
    {
        return $this->hasOne(LocaleSlugSeo::class, 'key')->where('rel_parent', 'products')->where('language', App::getLocale());
    }




    public function image_featured_preview()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'preview')->where('content', 'featured')->where('entity', 'products');
    }

    public function image_featured_preview_lang()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'preview')->where('content', 'featured')->where('entity', 'products')->where('language', App::getLocale());
    }

    public function image_featured_desktop()
    {
        return $this->hasOne(ImageResized::class, 'entity_id')->where('grid', 'desktop')->where('content', 'featured')->where('entity', 'products')->where('language', App::getLocale());
    }

    public function image_featured_mobile()
    {
        return $this->hasOne(ImageResized::class, 'entity_id')->where('grid', 'mobile')->where('content', 'featured')->where('entity', 'products')->where('language', App::getLocale());
    }

    public function image_grid_preview()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'preview')->where('content', 'grid')->where('entity', 'products');
    }

    public function image_grid_preview_lang()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'preview')->where('content', 'grid')->where('entity', 'products')->where('language', App::getLocale());
    }

    public function image_grid_desktop()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'desktop')->where('content', 'grid')->where('entity', 'products')->where('language', App::getLocale());
    }

    public function image_grid_mobile()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'mobile')->where('content', 'grid')->where('entity', 'products')->where('language', App::getLocale());
    }
}
