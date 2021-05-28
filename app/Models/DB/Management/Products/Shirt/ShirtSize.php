<?php
namespace App\Models\DB\shirt;

use App\Models\DB\DBModel;

class ShirtSize extends DBModel
{

    protected $table = 't_shirts_sizes';

    public function shirts()
    {
        return $this->hasMany(Shirt::class, 'id_shirt_size');
    }
} 

