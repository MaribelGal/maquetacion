<?php

namespace app\Models\DB\Management\Products;

use App\Models\DB\DBModel;
use app\Models\DB\Management\Products\Shirt\Shirt;
use app\Models\DB\Management\Products\Shirt\ShirtTissue;

use App\Vendor\Locale\Models\Locale;

use App;

class Tissue extends DBModel
{
    protected $table = 't_tissues';

    public function shirts()
    {
        return $this->hasMany(ShirtTissue::class, 'tissue_id');
    }

    
    public function locale()
    {
        return $this->hasMany(Locale::class, 'key')->where('rel_parent', 'tissues')->where('language', App::getLocale());
    }
    
}
