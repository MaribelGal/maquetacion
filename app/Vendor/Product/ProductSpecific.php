<?php

namespace App\Vendor\Product;

use App\Vendor\Product\Models\Product as DBProduct;
use App\Models\DB\Management\Products\Shirt\Shirt;
use App\Models\DB\Management\Products\Shirt\ShirtColor;
use App\Models\DB\Management\Products\Shirt\ShirtSize;

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
        if ($this->table == 'shirts') {
            return $this->shirt;
        }
    }

    public function storeSpecificProduct($i, $productRequest, $idRequest, $visibleRequest)
    {

        if ($productRequest['size']) {
            ShirtSize::updateOrCreate([
                'size_id' => $productRequest['size'][$i],
                'product_id' => $idRequest,
            ], [
                'visible' => $visibleRequest
            ]);
        }

        if ($productRequest['color']) {
            ShirtColor::updateOrCreate([
                'color_id' => $productRequest['color'][$i],
                'product_id' => $idRequest,
            ], [
                'visible' => $visibleRequest
            ]);
        }

        // if ($productRequest['tissue']) {
        //     # code...
        // }

    }
}
