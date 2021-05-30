<?php

namespace App\Models\DB\Management;

use App\Models\DB\DBModel;
use App\Models\DB\Management\Products\Shirt\Shirt;

class Brand extends DBModel
{

    protected $table = 't_brands';

    public function shirts()
    {
        return $this->hasMany(Shirt::class, 'id_brand');
    }
} 