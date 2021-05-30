<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;

class ShirtSleeve extends DBModel
{

    protected $table = 't_shirts_sleeves';

    public function shirts()
    {
        return $this->belongsTo(Shirt::class, 'id_shirt_sleeve');
    }
} 

