<?php

namespace App\Models\DB\shirt;

use App\Models\DB\DBModel;

class ShirtType extends DBModel
{

    protected $table = 't_shirts_types';

    public function shirts()
    {
        return $this->hasMany(Shirt::class, 'id_shirt_type');
    }
} 

