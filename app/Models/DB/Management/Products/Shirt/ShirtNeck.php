<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;


class ShirtNeck extends DBModel
{

    protected $table = 't_shirts_necks';

    public function shirts()
    {
        return $this->belongsTo(Shirt::class, 'id_shirt_neck');
    }
} 
