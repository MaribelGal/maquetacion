<?php

namespace App\Http\Controllers\Admin\Management\Products\Shirt;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Vendor\Locale\Locale;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Vendor\Image\Image;
use App\Vendor\Product\Product;
use App\Models\DB\Management\Products\Shirt\Shirt;
use Debugbar;
use Jenssegers\Agent\Agent;

class ShirtController extends Controller
{
    protected $shirt;
    protected $locale;
    protected $localeSlugSeo;
    protected $image;
    protected $product;
    protected $agent;
    protected $paginationNum;

    function __construct(Shirt $shirt, Agent $agent, Locale $locale, LocaleSlugSeo $localeSlugSeo, Image $image, Product $product){
        $this->middleware('auth');
        $this->shirt = $shirt;
        $this->locale = $locale;
        $this->localeSlugSeo = $localeSlugSeo;
        $this->image = $image;
        $this->product = $product;
        $this->agent = $agent;
        

        if ($this->agent->isMobile()) {
            $this->paginationNum = 6;
        }

        if ($this->agent->isDesktop()) {
            $this->paginationNum = 3;
        }

        $this->locale->setParent('products');
        $this->localeSlugSeo->setParent('products');
        $this->image->setEntity('products');
        $this->product->setTable('shirts');
    }

    public function index(){

        $paginate = $this->shirt->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum);

        $view = View::make('admin.shirts.index')
            ->with('shirt', $this->shirt)
            ->with('shirts', $paginate);

        if (request()->ajax()) {

            $sections = $view->renderSections();

            return response()->json([
                'table' => $sections['table'],
                'tablerows' => $sections['tablerows'],
                'form' => $sections['form'],
            ]);
        }

        return $view;
    }

    public function store() {

        DebugBar::info(request());

        $shirt = $this->shirt->updateOrCreate([
            'id' => request('id')
        ], [
            'name' => request('name'),
            'shirt_size_id' => request('size'),
            'shirt_sleeve_id' => request('sleeve'),
            'shirt_neck_id' => request('neck'),
            'shirt_pattern_id' => request('pattern'),
            'color_id' => request('color'),
            'brand_id' => request('brand'),
            'visible' => request('visible'),
            'active' => 1,
        ]);

        if (request('product')){
            $product = $this->product->store(request('product'), $shirt->id, request('visible'));
        }

        DebugBar::info($product);


        // if(request('seo')){
        //     $seo = $this->localeSlugSeo->store(request('seo'), $product->id, 'front_shirt');
        // }

        if (request('locale')) {
            $locale = $this->locale->store(request('locale'), $product->id);
        }
        
        if (request('images')) {
            $images = $this->image->storeRequest(request('images'), 'webp', $product->id);
        }



        if (request('id')) {
            $message = \Lang::get('admin/shirts.shirt-update');
        } else {
            $message = \Lang::get('admin/shirts.shirt-create');
        }

        $paginate = $this->shirt->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum);

        $view = View::make('admin.shirts.index')
            ->with('shirt', $this->shirt)
            ->with('shirts', $paginate);

        $sections = $view->renderSections();

        return response()->json([
            'table' => $sections['table'],
            'tablerows' => $sections['tablerows'],
            'form' => $sections['form'],
            'product_id' => $product->id
        ]);
    }

    public function show(Shirt $shirt) {
        $locale = $this->locale->show($shirt->id);
        $seo = $this->localeSlugSeo->show($shirt->id);
        $product = $this->product->show($shirt->id);

        $shirts = $this->shirt->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum);

        debugbar::info($shirts);

        $view = View::make('admin.shirts.index')
            ->with('product', $product)
            ->with('locale', $locale)
            ->with('seo', $seo)
            ->with('shirt', $shirt)
            ->with('shirts', $shirts);

        if (request()->ajax()) {

            $sections = $view->renderSections();

            return response()->json([
                'form' => $sections['form'],
                'table' => $sections['table'],
                'tablerows' => $sections['tablerows'],
            ]);
        }

        return $view;
    }

}