<?php

namespace App\Vendor\Product;

use App\Vendor\Product\Models\Product as DBProduct;
use App\Models\DB\Management\Products\Shirt\Shirt;

use Debugbar;

class ProductSpecific
{
    protected $table;
    protected $product;
    protected $shirt;


    public function __construct(
        DBProduct $product,
        Shirt $shirt
    ) {
        $this->product = $product;
        $this->shirt = $shirt;
    }

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function specificModelProduct()
    {
        if ($this->table == 'shirts'){
            return $this->shirt;
        }
    }

}
