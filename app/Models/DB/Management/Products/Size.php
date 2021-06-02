<?php

namespace App\Models\DB\Management\Products;

use App\Models\DB\DBModel;
use App\Vendor\Locale\Models\Locale;

use App;
use App\Models\DB\Management\Products\Shirt\ShirtSize;

class Size extends DBModel
{

    protected $table = 't_sizes';

    public function shirts()
    {
        return $this->hasMany(ShirtSize::class, 'size_id');
    }
    
    public function locale()
    {
        return $this->hasMany(Locale::class, 'key')->where('rel_parent', 'sizes')->where('language', App::getLocale());
    }
} 