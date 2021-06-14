<?php

namespace App\Vendor\Product;

use App\Vendor\Product\Models\Product as DBProduct;
use App\Vendor\Product\Models\ProductCost;
use App\Vendor\Product\Models\ProductPriceModifier;
use App\Vendor\Product\Models\ProductPricePurchase;
use App\Vendor\Product\Models\ProductPriceRent;
use App\Vendor\Product\Models\ProductStock;
use App\Vendor\Product\Models\ProductGroup;

use App\Models\DB\Management\PriceModifier;

use App\Vendor\Product\ProductSpecific;

use Debugbar;

class Product
{
    protected $table;
    protected $product;
    protected $productCost;
    protected $productPriceModifier;
    protected $productPricePurchase;
    protected $productPriceRent;
    protected $productStock;
    protected $productGroup;
    protected $priceModifier;
    protected $productSpecific;

    protected $total_increases_sum;
    protected $total_decreases_sum;

    private $groupRequest;

    public function __construct(
        DBProduct $product,
        ProductCost $productCost,
        ProductStock $productStock,
        ProductGroup $productGroup,
        ProductPriceRent $productPriceRent,
        ProductPriceModifier $productPriceModifier,
        ProductPricePurchase $productPricePurchase,
        PriceModifier $priceModifier,
        ProductSpecific $productSpecific
    ) {
        $this->product = $product;
        $this->productCost = $productCost;
        $this->productPriceModifier = $productPriceModifier;
        $this->productPricePurchase = $productPricePurchase;
        $this->productPriceRent = $productPriceRent;
        $this->productStock = $productStock;
        $this->productGroup = $productGroup;
        $this->priceModifier = $priceModifier;
        $this->productSpecific = $productSpecific;

        $this->total_decreases_sum = [];
        $this->total_increases_sum = [];
    }

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function storeProductGroup(
        $productGroup,
        $name,
        $visible
        ) {
        $productGroup = $this->productGroup->updateOrCreate([
            'id' => $productGroup['id']
        ], [
            'category_id' => $productGroup['category_id'],
            'name' => $name,
            'visible' => $visible == "true" ? 1 : 0 ,
            'active' => 1
        ]);

        return $productGroup;
    }

    public function storeProduct($productGroupId, $productRequest, $visibleRequest){
        $this->productSpecific->setTable($this->table);

        $specificModel = $this->productSpecific->specificModelProduct();

        $specificProduct = $specificModel->updateOrCreate([
            'id' => $productRequest['specific']['id']
        ], [
            'model_id' => $productRequest['specific']['model'],
            'visible' => $visibleRequest,
            'active' => 1
        ]);

        foreach ($productRequest['specific']['col'] as $columnName => $value) {
            $specificProduct = $specificModel->updateOrCreate([
                'id' => $productRequest['specific']['id']
            ], [
                $columnName => $value,
            ]);
        }


        $product = $this->product->updateOrCreate([
            'id' => $productRequest['id']
        ], [
            'product_group_id' => $productRequest['group']->id,
            'product_specific_table' => $this->table,
            'product_specific_id' => $specificProduct->id,
            'visible' => $visibleRequest,
            'active' => 1
        ]);


        $productCost = $this->productCost->updateOrCreate([
            'product_id' => $product['item']->id,
            'supplier_id' => $productRequest['supplier'],
            'cost' => $productRequest['cost'],
            'visible' => $visibleRequest,
            'active' => 1
        ]);

        $productStock = $this->productStock->updateOrCreate([
            'product_id' => $product['item']->id,
            'quantity' => $productRequest['stock'],
            'visible' => $visibleRequest,
            'active' => 1
        ]);

        foreach ($productRequest['modifier'] as $key_sale_method => $array_sale_method) {

            $this->total_increases_sum[$key_sale_method] = null;
            $this->total_decreases_sum[$key_sale_method] = null;

            foreach ($array_sale_method as $modifier_id) {

                $productPriceModifier = $this->productPriceModifier->updateOrCreate([
                    'product_id' => $product['item'][$i]->id,
                    'modifier_id' => $modifier_id[$i],
                    'sale_method' => $key_sale_method,
                    'visible' => $visibleRequest,
                    'active' => 1
                ]);

                $mod = $this->priceModifier->find($modifier_id[$i])->get();

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


        $productPricePurchase = $this->productPricePurchase->updateOrCreate([
            'product_id' => $product['item'][$i]->id,
            'total_increases_sum' => $this->total_increases_sum['purchase'],
            'total_decreases_sum' => $this->total_decreases_sum['purchase'],
            'price' => $productRequest['price']['purchase'][$i],
            'visible' => $visibleRequest,
            'active' => 1
        ]);

        $productPriceRent = $this->productPriceRent->updateOrCreate([
            'product_id' => $product['item'][$i]->id,
            'total_increases_sum' => $this->total_increases_sum['rent'],
            'total_decreases_sum' => $this->total_decreases_sum['rent'],
            'price_hour' => $productRequest['price']['rent'][$i],
            'visible' => $visibleRequest,
            'active' => 1
        ]);

        return $product;
    }

   private function storeProductPricePurchase()
   {
       $productPricePurchase = $this->productPricePurchase->updateOrCreate([
            'product_id' => $product['item'][$i]->id,
            'total_increases_sum' => $this->total_increases_sum['purchase'],
            'total_decreases_sum' => $this->total_decreases_sum['purchase'],
            'price' => $productRequest['price']['purchase'][$i],
            'visible' => $visibleRequest,
            'active' => 1
        ]);
   }


    public function show($specific_id)
    {
        $product = $this->product->where('product_specific_table', $this->table)->where('product_specific_id', $specific_id)->get();

        return $product;
    }

    public function showSpecific($table)
    {
        $this->productSpecific->setTable($table);
        return $this->productSpecific->specificModelProduct();
    }
}
