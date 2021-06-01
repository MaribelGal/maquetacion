<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Vendor\Product\Models\Product as DBProduct;
use App\Vendor\Product\Product;
use Debugbar;

class ProductController extends Controller
{
    protected $agent;
    protected $DBproduct;
    protected $product;
    protected $locale_slug_seo;

    function __construct(Agent $agent, DBProduct $DBproduct, Product $product, LocaleSlugSeo $locale_slug_seo)
    {
        $this->agent = $agent;
        $this->DBproduct = $DBproduct;
        $this->product = $product;
        $this->locale_slug_seo = $locale_slug_seo;

        $this->locale_slug_seo->setLanguage(app()->getLocale()); 
        $this->locale_slug_seo->setParent('products');      
    }

    public function index()
    {        
        $seo = $this->locale_slug_seo->getByKey(Route::currentRouteName());

        if($this->agent->isDesktop()){

            $products = $this->DBproduct
                    ->with('image_featured_desktop')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->get();
        }
        
        elseif($this->agent->isMobile()){
            $products = $this->DBproduct
                    ->with('image_featured_mobile')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->get();
        }

        $products = $products->each(function($product){  
            
            $product['locale'] = $product->locale->pluck('value','tag');
            
            return $product;
        });

        $view = View::make('front.pages.products.index')
                ->with('products', $products) 
                ->with('seo', $seo );
        
        return $view;
    }

    public function show($slug)
    {      
        $seo = $this->locale_slug_seo->getIdByLanguage($slug);

        if(isset($seo->key)){

            if($this->agent->isDesktop()){
                $product = $this->DBproduct
                    ->with('image_featured_desktop')
                    ->with('image_grid_desktop')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->find($seo->key);
            }
            
            elseif($this->agent->isMobile()){
                $product = $this->DBproduct
                    ->with('image_featured_mobile')
                    ->with('image_grid_mobile')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->find($seo->key);
            }

            $table = $product->product_specific_table;

            $specific_model = $this->product->showSpecific($table);


            $product_specific = $specific_model->where('id', $product->product_specific_id)->get()[0];

            $price_product = $product->price_purchase->price;
            $decreases = $product->price_purchase->total_decreases_sum;
            $increases = $product->price_purchase->total_increases_sum;

            $price['final'] = round((($price_product*(1-($decreases)))*(1+($increases))), 2);
      
            if($decreases > 0){
                $price['original'] = (($price_product*(1+($increases))));
                $price['discount'] = $decreases*100;
            } 

            $product['locale'] = $product->locale->pluck('value','tag');

            $view = View::make('front.pages.products.single')
                ->with('product', $product)
                ->with('product_specific', $product_specific)
                ->with('price', $price);

            return $view;

        }else{
            return response()->view('errors.404', [], 404);
        }
    }
}