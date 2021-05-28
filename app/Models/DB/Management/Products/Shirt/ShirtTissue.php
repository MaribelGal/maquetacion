<?php

namespace App\Models\DB\shirt;

use App\Models\DB\DBModel;
use app\Models\DB\Management\Products\Tissue;

class ShirtTissue extends DBModel
{

    protected $table = 't_shirts_tissues';


    public function tissue()
    {
        return $this->belongsTo(Tissue::class, 'id_shirt');
    }
} 
