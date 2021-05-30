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
use App\Models\DB\Management\Products\Shirt\Shirt;
use Debugbar;
use Jenssegers\Agent\Agent;

class ShirtController extends Controller
{
    protected $shirt;
    protected $locale;
    protected $localeSlugSeo;
    protected $image;
    protected $agent;
    protected $paginationNum;

    function __construct(Shirt $shirt, Agent $agent, Locale $locale, LocaleSlugSeo $localeSlugSeo, Image $image)
    {
        $this->middleware('auth');
        $this->shirt = $shirt;
        $this->locale = $locale;
        $this->localeSlugSeo = $localeSlugSeo;
        $this->image = $image;
        $this->agent = $agent;

        if ($this->agent->isMobile()) {
            $this->paginationNum = 6;
        }

        if ($this->agent->isDesktop()) {
            $this->paginationNum = 3;
        }

        $this->locale->setParent('shirts');
        $this->localeSlugSeo->setParent('shirts');
        $this->image->setEntity('shirts');
    }

    public function index()
    {

        $paginate = $this->shirt->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum);

        $view = View::make('admin.shirts.index')
            ->with('shirt', $this->shirt)
            ->with('shirts', $paginate);

        // $paginate->withPath('/admin/shirts');

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
}