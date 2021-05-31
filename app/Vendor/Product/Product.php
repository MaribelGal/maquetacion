<?php

namespace App\Vendor\Product;

use App\Vendor\Product\Models\Product as DBProduct;
use App\Vendor\Product\Models\ProductCost;
use App\Vendor\Product\Models\ProductPriceModifier;
use App\Vendor\Product\Models\ProductPricePurchase;
use App\Vendor\Product\Models\ProductPriceRent;
use App\Vendor\Product\Models\ProductStock;

use App\Models\DB\Management\PriceModifier;

use Debugbar;

class Product {
	protected $table;
    protected $product;
    protected $productCost;
    protected $productPriceModifier;
    protected $productPricePurchase;
    protected $productPriceRent;
    protected $productStock;
    protected $PriceModifier;

    protected $total_increases_sum;
    protected $total_decreases_sum;

    public function __construct(
        DBProduct $product, 
        ProductCost $productCost, 
        ProductStock $productStock, 
        ProductPriceRent $productPriceRent, 
        ProductPriceModifier $productPriceModifier,
        ProductPricePurchase $productPricePurchase,
        PriceModifier $priceModifier) 
    {
        $this->product = $product;
        $this->productCost = $productCost;
        $this->productPriceModifier = $productPriceModifier;
        $this->productPricePurchase = $productPricePurchase;
        $this->productPriceRent = $productPriceRent;
        $this->productStock = $productStock;
        $this->priceModifier = $priceModifier;

        $this->total_decreases_sum = [];
        $this->total_increases_sum = [];
    }

	public function setTable($table)
	{
		$this->table = $table;
	}

    public function store($productRequest, $idRequest , $visibleRequest) {

        $product = $this->product->updateOrCreate([
            'id' => $productRequest['id']
        ] , [
            'product_category_id' => $productRequest['category_id'],
            'product_specific_table' => $this->table,
            'product_specific_id' => $idRequest,
            'visible' => $visibleRequest,
            'active' => 1
        ]);

        $productCost = $this->productCost->create([
            'product_id' => $product->id,
            'supplier_id' => $productRequest['supplier'],
            'cost' => $productRequest['cost'],
            'visible' => $visibleRequest,
            'active' => 1
        ]);

        $productStock = $this->productStock->create([
            'product_id' => $product->id,
            'quantity' => $productRequest['stock'],
            'visible' => $visibleRequest,
            'active' => 1
        ]);

        foreach ($productRequest['modifier'] as $key_sale_method => $array_sale_method) {

            $this->total_increases_sum[$key_sale_method] = null;
            $this->total_decreases_sum[$key_sale_method] = null;

            foreach ($array_sale_method as $modifier_id) {

                $productPriceModifier = $this->productPriceModifier->create([
                    'product_id' => $product->id,
                    'modifier_id' => $modifier_id,
                    'sale_method' => $key_sale_method,
                    'visible' => $visibleRequest,
                    'active' => 1
                ]);

                

                $mod = $this->priceModifier->find($modifier_id)->get();

                Debugbar::info($mod[0]);


                if ($mod[0]->modifier == 'inc') {
                    $this->total_increases_sum[$key_sale_method] += ($mod[0]->percentage - 1);
                };

                if ($mod[0]->modifier == 'dec') {
                    $this->total_decreases_sum[$key_sale_method] += ($mod[0]->percentage - 1);
                };
            }

            $this->total_increases_sum[$key_sale_method] += 1;
            $this->total_decreases_sum[$key_sale_method] += 1;

        }

        $productPricePurchase = $this->productPricePurchase->create([
            'product_id' => $product->id,
            'total_increases_sum' => $this->total_increases_sum['purchase'],
            'total_decreases_sum' => $this->total_decreases_sum['purchase'],
            'price' => $productRequest['price']['purchase'],
            'visible' => $visibleRequest,
            'active' => 1
        ]);
        
        $productPriceRent = $this->productPriceRent->create([
            'product_id' => $product->id,
            'total_increases_sum' => $this->total_increases_sum['rent'],
            'total_decreases_sum' => $this->total_decreases_sum['rent'],
            'price_hour' => $productRequest['price']['rent'],
            'visible' => $visibleRequest,
            'active' => 1
        ]);

        return $product;
    }

    public function show($specific_id){
        return $this->product->where('product_specific_table', $this->table)->where('product_specific_id', $specific_id)->get();
    }
}


