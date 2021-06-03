<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Vendor\Product\Models\ProductGroup;
use App\Vendor\Product\Product;
use Debugbar;
use Schema;

class ProductController extends Controller
{
    protected $agent;
    protected $ProductGroup;
    protected $product;
    protected $locale_slug_seo;

    function __construct(Agent $agent, ProductGroup $ProductGroup, Product $product, LocaleSlugSeo $locale_slug_seo)
    {
        $this->agent = $agent;
        $this->ProductGroup = $ProductGroup;
        $this->product = $product;
        $this->locale_slug_seo = $locale_slug_seo;

        $this->locale_slug_seo->setLanguage(app()->getLocale());
        $this->locale_slug_seo->setParent('products_groups');
    }

    public function index()
    {
        $seo = $this->locale_slug_seo->getByKey(Route::currentRouteName());

        
        if ($this->agent->isDesktop()) {
            $products = $this->ProductGroup
                ->with('products')
                ->where('active', 1)
                ->where('visible', 1)
                ->get();
        } elseif ($this->agent->isMobile()) {
            $products = $this->ProductGroup
                ->with('products')
                ->where('active', 1)
                ->where('visible', 1)
                ->get();
        }

        $products = $products->each(function ($product) {

            $product['locale'] = $product->locale->pluck('value', 'tag');

            return $product;
        });

        $view = View::make('front.pages.products.index')
            ->with('products', $products)
            ->with('seo', $seo);

        return $view;
    }

    public function show($slug)
    {
        $seo = $this->locale_slug_seo->getIdByLanguage($slug);

        if (isset($seo->key)) {

            if ($this->agent->isDesktop()) {
                $productGroup = $this->ProductGroup
                    ->with('products')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->find($seo->key);
            } elseif ($this->agent->isMobile()) {
                $productGroup = $this->ProductGroup
                    ->with('products')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->find($seo->key);
            }

            $productGroup['locale'] = $productGroup->locale->pluck('value', 'tag');

            $table = $productGroup->products[0]->product_specific_table;

            $specific_model = $this->product->showSpecific($table);

            $product_specific = $specific_model
                ->where('id', $productGroup->products[0]->product_specific_id)
                ->get()[0];

            $product_specific_model = $product_specific->model_id;


            //PENDIENTE MOVER A VENDOR PRODUCT Y AGREGAR CAMPO EN BD
            $price_product = $productGroup->products[0]->price_purchase->price;

            $decreases = $productGroup->products[0]->price_purchase->total_decreases_sum;
            $increases = $productGroup->products[0]->price_purchase->total_increases_sum;

            $price['final'] = round((($price_product * (1 - ($decreases))) * (1 + ($increases))), 2);

            if ($decreases > 0) {
                $price['original'] = (($price_product * (1 + ($increases))));
                $price['discount'] = $decreases * 100;
            }

            $product_specific['price'] = $price;
            //////////////////////////////////////////////////////////

            $products_specifics = $specific_model->where('model_id', $product_specific_model)->get();

            

            

            $columnList = Schema::getColumnListing($specific_model->getTable());
            
            $activePosition = array_search('active', $columnList, true);
            $visiblePosition = array_search('visible', $columnList, true);
            $modelPosition = array_search('model_id', $columnList, true);
            $createdAtPosition = array_search('created_at', $columnList, true);
            $updatedAtPosition = array_search('updated_at', $columnList, true);
            $idPosition = array_search('id', $columnList, true);

            unset(
                $columnList[$activePosition],
                $columnList[$modelPosition],
                $columnList[$createdAtPosition],
                $columnList[$updatedAtPosition],
                $columnList[$idPosition],
                $columnList[$visiblePosition]);


            Debugbar::info($columnList);

            $variants = [];

            foreach ($columnList as $key => $value) {
                $variants[$value] = $specific_model->distinct($value)->where('model_id', $product_specific_model)->pluck($value)->all();
            }

            Debugbar::info($variants);

            $view = View::make('front.pages.products.single')
                ->with('product', $productGroup)
                ->with('price', $price)
                ->with('products_specifics', $products_specifics)
                ->with('product_specific_model', $product_specific_model)
                ->with('product_specific_table', $table)
                ->with('variants', $variants);

            return $view;
        } else {
            return response()->view('errors.404', [], 404);
        }
    }



    public function filterProductGroup(Request $request)
    {
        $productGroup = $this->ProductGroup->find(request('productGroup_id'));


        $specific_model = $this->product->showSpecific(request('product_specific_table'));

        $query = $specific_model->query();

        $query->where('model_id', request('product_specific_model'));

        foreach (request('variant') as $key => $value) {
            $query->where($key, $value);
        }

        // Debugbar::info($query->get());
        $columnList = Schema::getColumnListing($specific_model->getTable());
            
        $activePosition = array_search('active', $columnList, true);
        $visiblePosition = array_search('visible', $columnList, true);
        $modelPosition = array_search('model_id', $columnList, true);
        $createdAtPosition = array_search('created_at', $columnList, true);
        $updatedAtPosition = array_search('updated_at', $columnList, true);
        $idPosition = array_search('id', $columnList, true);

        unset(
            $columnList[$activePosition],
            $columnList[$modelPosition],
            $columnList[$createdAtPosition],
            $columnList[$updatedAtPosition],
            $columnList[$idPosition],
            $columnList[$visiblePosition]);


        Debugbar::info($columnList);

        $variants = [];

        foreach ($columnList as $key => $value) {
            $variants[$value] = $specific_model->distinct($value)->where('model_id', $product_specific_model)->pluck($value)->all();
        }

        Debugbar::info($variants);



        $products_specifics = $query->get();
        $product_specific_model = $products_specifics[0]->model_id;
        $table = $productGroup->products[0]->product_specific_table;


        $images = View::make('front.pages.products.desktop.product_images')
            ->with('product', $productGroup)
            ->with('products_specifics', $products_specifics)
            ->with('product_specific_model', $product_specific_model)
            ->with('product_specific_table', $table)->with('variants', $variants);

        $data = View::make('front.pages.products.desktop.product_data')
            ->with('product', $productGroup)
            ->with('products_specifics', $products_specifics)
            ->with('product_specific_model', $product_specific_model)
            ->with('product_specific_table', $table)->with('variants', $variants);

        $variants = View::make('front.pages.products.desktop.product_variants')
            ->with('product', $productGroup)
            ->with('products_specifics', $products_specifics)
            ->with('product_specific_model', $product_specific_model)
            ->with('product_specific_table', $table)->with('variants', $variants);


        if (request()->ajax()) {

            $imageSection = $images->render();
            $dataSection = $data->render();
            $variantsSection = $variants->render();

            return response()->json([
                'productImages' => $imageSection,
                'productData' => $dataSection,
                'productVariants' => $variantsSection
            ]);
        }

        return $images;
    }
}
