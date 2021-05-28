<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;
use App\Models\DB\Management\Products\Color;
use App\Models\DB\Management\Brand;
use App\Models\DB\Management\Products\Tissue;
use app\Models\DB\Management\Products\Shirt\ShirtTissue;

use App\Vendor\Locale\Models\Locale;
use App\Vendor\Locale\Models\LocaleSlugSeo;
use App\Vendor\Image\Models\ImageResized;
use App\Vendor\Image\Models\ImageOriginal;
use App;

class Shirt extends DBModel
{

    protected $table = 't_shirts';
    // protected $with = ['category', 'images'];

    public function type()
    {
        return $this->belongsTo(ShirtType::class);
    }

    public function size()
    {
        return $this->belongsTo(ShirtSize::class);
    }

    public function sleeve()
    {
        return $this->belongsTo(ShirtSleeve::class);
    }

    public function neck()
    {
        return $this->belongsTo(ShirtNeck::class);
    }

    public function pattern()
    {
        return $this->belongsTo(ShirtPattern::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function tissues()
    {
        return $this->hasMany(ShirtTissue::class, 'id_shirt');
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
