<?php

namespace App\Models\DB\shirt;

use App\Models\DB\DBModel;

class ShirtPattern extends DBModel
{

    protected $table = 't_shirts_patterns';

    public function shirts()
    {
        return $this->hasMany(Shirt::class, 'id_shirt_pattern');
    }
} 

