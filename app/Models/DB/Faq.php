<?php

namespace App\Models\DB;

use App\Vendor\Locale\Models\Locale;
use App\Vendor\Locale\Models\LocaleSlugSeo;
use App\Vendor\Image\Models\ImageResized;
use App\Vendor\Image\Models\ImageOriginal;
use App;

class Faq extends DBModel
{

    protected $table = 't_faqs';
    protected $with = ['category', 'images'];

    public function category()
    {
        return $this->belongsTo(FaqCategory::class);
    }
    
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
        return $this->hasMany(ImageResized::class, 'entity_id')->where('entity', 'faqs');
    }


    public function images_preview()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('entity', 'faqs')->where('grid', 'preview');
    }

    public function images_desktop()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('entity', 'faqs')->where('grid', 'desktop');
    }

    public function images_preview_featured()
    {
        return $this->images_preview()->where('content', 'featured');
    }

    

    public function image_featured_preview()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'preview')->where('content', 'featured')->where('entity', 'faqs');
    }

    public function image_featured_desktop()
    {
        return $this->hasOne(ImageResized::class, 'entity_id')->where('grid', 'desktop')->where('content', 'featured')->where('entity', 'faqs')->where('language', App::getLocale());
    }

    public function image_featured_mobile()
    {
        return $this->hasOne(ImageResized::class, 'entity_id')->where('grid', 'mobile')->where('content', 'featured')->where('entity', 'faqs')->where('language', App::getLocale());
    }

}
