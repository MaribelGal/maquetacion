<?php

namespace App\Models\DB\shirt;

use App\Models\DB\DBModel;


class ShirtNeck extends DBModel
{

    protected $table = 't_shirts_necks';

    public function shirts()
    {
        return $this->hasMany(Shirt::class, 'id_shirt_neck');
    }
} 
