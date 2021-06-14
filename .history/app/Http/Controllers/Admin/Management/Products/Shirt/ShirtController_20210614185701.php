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

    function __construct(Shirt $shirt, Agent $agent, Locale $locale, LocaleSlugSeo $localeSlugSeo, Image $image, Product $product)
    {
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

        $this->locale->setParent('products_groups');
        $this->localeSlugSeo->setParent('products_groups');
        $this->image->setEntity('products');
        $this->product->setTable('shirts');
    }

    public function index()
    {

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

    public function store()
    {
        DebugBar::info(request());

        if (request('product')) {
            $product = $this->product->storeProduct(
                request('product'),
                request('visible') == "true" ? 1 : 0
            );
        }

        if (request('images')) {
            $images = $this->image->store(request('images'), $product->id);
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
            ->with('product', $paginate);

        $sections = $view->renderSections();

        return response()->json([
            'table' => $sections['table'],
            'tablerows' => $sections['tablerows'],
            'form' => $sections['form'],
            // 'product' => $shirt_model->id
        ]);
    }

    public function edit(Shirt $shirt)
    {
        $product = $this->product->show($shirt->id)[0];

        $locale = $this->locale->show($product->id);
        $seo = $this->localeSlugSeo->show($product->id);

        $shirts = $this->shirt->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum);

        debugbar::info($product);
        debugbar::info($locale);

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
            ]);
        }

        return $view;
    }
}
