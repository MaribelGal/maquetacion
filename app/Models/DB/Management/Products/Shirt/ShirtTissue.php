<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;
use app\Models\DB\Management\Products\Tissue;
use app\Models\DB\Management\Products\Shirt\Shirt;

class ShirtTissue extends DBModel
{

    protected $table = 't_shirts_tissues';
    

    public function shirt()
    {
        return $this->belongsTo(Shirt::class);
    }
        
    public function tissue()
    {
        return $this->hasOne(Tissue::class);
    }
} 
