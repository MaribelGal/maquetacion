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
                ->with('image_featured_desktop')
                ->where('active', 1)
                ->where('visible', 1)
                ->get();
        } elseif ($this->agent->isMobile()) {
            $products = $this->ProductGroup
                ->with('image_featured_mobile')
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

            $price_product = $productGroup->products[0]->price_purchase->price;

            $decreases = $productGroup->products[0]->price_purchase->total_decreases_sum;
            $increases = $productGroup->products[0]->price_purchase->total_increases_sum;


            $price['final'] = round((($price_product * (1 - ($decreases))) * (1 + ($increases))), 2);

            if ($decreases > 0) {
                $price['original'] = (($price_product * (1 + ($increases))));
                $price['discount'] = $decreases * 100;
            }

            $product_specific['price'] = $price;


            $view = View::make('front.pages.products.single')
                ->with('product', $productGroup)
                ->with('product_specific', $product_specific);

            return $view;
        } else {
            return response()->view('errors.404', [], 404);
        }
    }



    public function filterProductGroup()
    {
        $product_specific;
        /* intencion: reducir el productGroup con el nuevo filtro 
            y pasar el primero del productGroup como productSpecific

            ¿como se que filtro aplicar?

            envio:
            - dataset variant_name y su value 
            - id del productGroup
            
            con el productgroup accedo a la tabla
            pillo el modelo especifico 
            
            busco en el modelo las ids a traves del productGroup_product

            where con id = id1 o id2 o id3

            bucle: where variant_name = value1

        */

        $images = View::make('front.pages.products.desktop.product_images')
            ->with('product', $productGroup)
            ->with('product_specific', $product_specific);

        $data = View::make('front.pages.products.desktop.product_data')
            ->with('product', $productGroup)
            ->with('product_specific', $product_specific);

        $variants = View::make('front.pages.products.desktop.product_variants')
            ->with('product', $productGroup)
            ->with('product_specific', $product_specific);


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
