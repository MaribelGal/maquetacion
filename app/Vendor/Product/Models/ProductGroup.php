<?php

namespace App\Vendor\Product\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DB\Management\Supplier;
use App\Vendor\Product\Models\Product;
use App\Vendor\Locale\Models\Locale;
use App\Vendor\Locale\Models\LocaleSlugSeo;
use App;

class ProductGroup extends Model
{
    protected $table = 't_products_groups';
    protected $guarded = [];  


    public function products()
    {
        return $this->hasMany(Product::class, 'product_group_id');
    }



    public function locale()
    {
        return $this->hasMany(Locale::class, 'key')->where('rel_parent', 'products_groups')->where('language', App::getLocale());
    }

    public function seo()
    {
        return $this->hasOne(LocaleSlugSeo::class, 'key')->where('rel_parent', 'products_groups')->where('language', App::getLocale());
    }
}
