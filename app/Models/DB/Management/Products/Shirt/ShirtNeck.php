<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;
use App\Vendor\Locale\Models\Locale;

use App;


class ShirtNeck extends DBModel
{

    protected $table = 't_shirts_necks';

    public function shirts()
    {
        return $this->belongsTo(Shirt::class, 'id_shirt_neck');
    }

    public function locale()
    {
        return $this->hasMany(Locale::class, 'key')->where('rel_parent', 'shirts_necks')->where('language', App::getLocale());
    }
} 
