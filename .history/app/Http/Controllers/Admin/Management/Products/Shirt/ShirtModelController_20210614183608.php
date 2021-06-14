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
use App\Models\DB\Management\Products\Shirt\ShirtModel;

use Debugbar;
use Jenssegers\Agent\Agent;

class ShirtModelController extends Controller
{
    protected $shirtModel;
    protected $locale;
    protected $localeSlugSeo;
    protected $image;
    protected $product;
    protected $agent;
    protected $paginationNum;

    function __construct(ShirtModel $shirtModel, Agent $agent, Locale $locale, LocaleSlugSeo $localeSlugSeo, Image $image, Product $product)
    {
        $this->middleware('auth');
        $this->shirtModel = $shirtModel;
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


    public function store()
    {
        DebugBar::info('store');

        $shirt_model = $this->shirtModel->updateOrCreate([
            'id' => request('shirt_model_id')
        ], [
            'name' => request('name'),
            'shirt_sleeve_id' => request('sleeve'),
            'shirt_neck_id' => request('neck'),
            'shirt_pattern_id' => request('pattern'),
            'brand_id' => request('brand'),
            'visible' => request('visible') == "true" ? 1 : 0 ,
            'active' => 1,
        ]);


        if (request('productGroup')) {
            $productGroup = $this->product->storeProductGroup(
                request('productGroup'),
                request('name'),
                request('visible')
            );
        }

        // DebugBar::info($productGroup->id);
        // DebugBar::info(request());

        if (request('seo')) {
            $seo = $this->localeSlugSeo->store(request('seo'), $productGroup->id, 'front_product');
        }

        if (request('locale')) {
            $locale = $this->locale->store(request('locale'), $productGroup->id);
        }


        if (request('id')) {
            $message = \Lang::get('admin/shirts.shirt-update');
        } else {
            $message = \Lang::get('admin/shirts.shirt-create');
        }

        $paginate = $this->shirtModel->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum);

        $view = View::make('admin.shirts.index')
            ->with('shirtModel', $shirt_model)
            ->with('shirt', $this->shirtModel)
            ->with('shirts', $paginate)
            ->with('productGroup', $productGroup);

        $sections = $view->renderSections();

        return response()->json([
            'table' => $sections['table'],
            'form' => $sections['form'],
            // 'product_id' => $shirt_model->id,
            // 'productGroup_id' => $productGroup->id
        ]);
    }


}
