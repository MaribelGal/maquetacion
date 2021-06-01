<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;
use App\Models\DB\Management\Products\Color;
use App\Models\DB\Management\Products\Shirt\Shirt;

class ShirtColor extends DBModel
{

    protected $table = 't_shirts_tissues';
    

    public function shirt()
    {
        return $this->belongsTo(Shirt::class, 'shirt_id');
    }
        
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
} 
