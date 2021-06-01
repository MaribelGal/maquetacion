<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;
use App\Vendor\Locale\Models\Locale;

use App;

class ShirtPattern extends DBModel
{

    protected $table = 't_shirts_patterns';

    public function shirts()
    {
        return $this->belongsTo(Shirt::class, 'id_shirt_pattern');
    }

    public function locale()
    {
        return $this->hasMany(Locale::class, 'key')->where('rel_parent', 'shirts_patterns')->where('language', App::getLocale());
    }
} 

