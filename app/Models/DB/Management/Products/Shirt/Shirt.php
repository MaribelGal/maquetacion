<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;
use App\Models\DB\Management\Products\Color;
use App\Models\DB\Management\Products\Size;
use app\Models\DB\Management\Products\Shirt\ShirtColor;
use App\Models\DB\Management\Brand;
use App\Models\DB\Management\Products\Tissue;
use App\Models\DB\Management\Products\Shirt\ShirtTissue;
use App\Models\DB\Management\Products\Shirt\ShirtModel;
use App\Vendor\Product\Models\Product;

use App\Vendor\Locale\Models\Locale;
use App\Vendor\Locale\Models\LocaleSlugSeo;
use App\Vendor\Image\Models\ImageResized;
use App\Vendor\Image\Models\ImageOriginal;
use App;

class Shirt extends DBModel
{

    protected $table = 't_shirts';
    // protected $with = ['category', 'images'];

    public function model() {
        return $this->belongsTo(ShirtModel::class, 'model_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }


    public function product() {
        return $this->hasOne(Product::class, 'product_specific_id')->where('product_specific_table', 'shirts');
    }



    /// LOCALE + SEO + IMAGES
    public function locale()
    {
        return $this->hasMany(Locale::class, 'key')->where('rel_parent', 'faqs')->where('language', App::getLocale());
    }

    public function seo()
    {
        return $this->hasOne(LocaleSlugSeo::class, 'key')->where('rel_parent', 'faqs')->where('language', App::getLocale());
    }

    public function images()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('entity', 'faqs')->where('language', App::getLocale());
    }

    public function images_contents()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->select('content')->where('entity', 'faqs')->distinct();
    }






    public function image_featured_preview()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'preview')->where('content', 'featured')->where('entity', 'faqs')->where('language', App::getLocale());
    }

    public function image_featured_desktop()
    {
        return $this->hasOne(ImageResized::class, 'entity_id')->where('grid', 'desktop')->where('content', 'featured')->where('entity', 'faqs')->where('language', App::getLocale());
    }

    public function image_featured_mobile()
    {
        return $this->hasOne(ImageResized::class, 'entity_id')->where('grid', 'mobile')->where('content', 'featured')->where('entity', 'faqs')->where('language', App::getLocale());
    }

    public function image_grid_preview()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'preview')->where('content', 'grid')->where('entity', 'faqs')->where('language', App::getLocale());
    }

    public function image_grid_desktop()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'desktop')->where('content', 'grid')->where('entity', 'faqs')->where('language', App::getLocale());
    }

    public function image_grid_mobile()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'mobile')->where('content', 'grid')->where('entity', 'faqs')->where('language', App::getLocale());
    }
}
