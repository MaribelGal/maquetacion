<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;
use App\Vendor\Locale\Models\Locale;

use App;

class ShirtSleeve extends DBModel
{

    protected $table = 't_shirts_sleeves';

    public function shirts()
    {
        return $this->belongsTo(Shirt::class, 'id_shirt_sleeve');
    }

    public function locale()
    {
        return $this->hasMany(Locale::class, 'key')->where('rel_parent', 'shirts_sleeves')->where('language', App::getLocale());
    }
} 

