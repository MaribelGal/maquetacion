<?php

namespace app\Models\DB\Management\Products;

use App\Models\DB\DBModel;

class Color extends DBModel
{

    protected $table = 't_colors';

    public function shirts()
    {
        return $this->hasMany(Shirt::class, 'id_color');
    }
} 