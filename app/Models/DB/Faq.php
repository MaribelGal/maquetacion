<?php

namespace App\Models\DB;

use App\Vendor\Locale\Models\Locale;
use App\Vendor\Image\Models\Image;
use App;

class Faq extends DBModel
{

    protected $table = 't_faqs';
    protected $with = 'category';

    public function category()
    {
        return $this->belongsTo(FaqCategory::class);
    }

        
    public function locale()
    {
        return $this->hasMany(Locale::class, 'key')->where('rel_parent', 'faqs')->where('language', App::getLocale());
    }
} 
