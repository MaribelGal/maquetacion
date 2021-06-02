<?php

namespace App\Models\DB\Management\Products\Shirt;

use App\Models\DB\DBModel;
use App\Models\DB\Management\Products\Color;
use app\Models\DB\Management\Products\Shirt\ShirtColor;
use App\Models\DB\Management\Brand;
use App\Models\DB\Management\Products\Tissue;
use App\Models\DB\Management\Products\Shirt\Shirt;
use App\Models\DB\Management\Products\Shirt\ShirtTissue;
use App\Models\DB\Management\Products\Shirt\ShirtNeck;
use App\Models\DB\Management\Products\Shirt\ShirtSleeve;
use App\Models\DB\Management\Products\Shirt\ShirtPattern;
use App\Vendor\Product\Models\Product;

use App\Vendor\Locale\Models\Locale;
use App\Vendor\Locale\Models\LocaleSlugSeo;
use App\Vendor\Image\Models\ImageResized;
use App\Vendor\Image\Models\ImageOriginal;
use App;

class ShirtModel extends DBModel
{
    protected $table = 't_shirts_models';

    public function sleeve()
    {
        return $this->belongsTo(ShirtSleeve::class, 'shirt_sleeve_id');
    }

    public function neck()
    {
        return $this->belongsTo(ShirtNeck::class, 'shirt_neck_id');
    }

    public function pattern()
    {
        return $this->belongsTo(ShirtPattern::class, 'shirt_pattern_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function tissues()
    {
        return $this->hasMany(ShirtTissue::class, 'product_id');
    }

    public function products()
    {
        return $this->hasMany(Shirt::class, 'model_id');
    }


}