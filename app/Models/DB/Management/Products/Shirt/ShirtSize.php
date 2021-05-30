<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;

class ShirtSize extends DBModel
{

    protected $table = 't_shirts_sizes';

    public function shirts()
    {
        return $this->belongsTo(Shirt::class, 'id_shirt_size');
    }
} 

