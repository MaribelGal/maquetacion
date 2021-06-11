<?php

namespace App\Models\DB\Management\Products;

use App\Models\DB\DBModel;
use App\Models\DB\Management\Products\Tissue;
use App\Models\DB\Management\Products\Shirt\Shirt;

class ModelTissue extends DBModel
{

    protected $table = 't_models_tissues';
    

    public function shirt()
    {
        return $this->belongsTo(Shirt::class);
    }
        
    public function tissue()
    {
        return $this->belongsTo(Tissue::class, 'tissue_id');
    }
} 
