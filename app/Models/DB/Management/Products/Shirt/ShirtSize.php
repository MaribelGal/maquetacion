<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;
use App\Vendor\Locale\Models\Locale;

use App;

class ShirtSize extends DBModel
{

    protected $table = 't_shirts_sizes';

    public function shirts()
    {
        return $this->belongsTo(Shirt::class, 'id_shirt_size');
    }

    public function locale()
    {
        return $this->hasMany(Locale::class, 'key')->where('rel_parent', 'shirts_sizes')->where('language', App::getLocale());
    }
} 

