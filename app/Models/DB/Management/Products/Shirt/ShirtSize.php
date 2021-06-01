<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;
use App\Vendor\Locale\Models\Locale;
use App\Models\DB\Management\Products\Size;

use App;

class ShirtSize extends DBModel
{

    protected $table = 't_shirts_sizes';

    public function shirt()
    {
        return $this->belongsTo(Shirt::class, 'shirt_id');
    }

    public function locale()
    {
        return $this->hasMany(Locale::class, 'key')->where('rel_parent', 'shirts_sizes')->where('language', App::getLocale());
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
} 

