<?php

namespace App\Models\DB\shirt;

use App\Models\DB\DBModel;

class ShirtSleeve extends DBModel
{

    protected $table = 't_shirts_sleeves';

    public function shirts()
    {
        return $this->hasMany(Shirt::class, 'id_shirt_sleeve');
    }
} 

