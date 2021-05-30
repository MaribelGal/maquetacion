<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;

class ShirtPattern extends DBModel
{

    protected $table = 't_shirts_patterns';

    public function shirts()
    {
        return $this->belongsTo(Shirt::class, 'id_shirt_pattern');
    }
} 

