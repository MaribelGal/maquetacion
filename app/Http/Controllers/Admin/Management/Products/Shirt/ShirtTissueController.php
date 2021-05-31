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
use App\Models\DB\Management\Products\Shirt\ShirtTissue;
use Debugbar;
use Jenssegers\Agent\Agent;

class ShirtTissueController extends Controller
{
    protected $shirtTissue;


    function __construct(ShirtTissue $shirtTissue){
        $this->middleware('auth');
        $this->shirtTissue = $shirtTissue;
    }

    public function store() {

        DebugBar::info(request());
        
        $num = count(request('tissue'));

        for ($i=0; $i < $num; $i++) {

            $shirtTissue = $this->shirtTissue->updateOrCreate([
                'id' => request('id')
            ], [
                'tissue_id' => request('tissue')[$i],
                'product_id' => request('id-parent'),
                'percentage_tissue' => request('percentage')[$i],
                'visible' => request('visible'),
                'active' => 1,
            ]);

            DebugBar::info($shirtTissue);
        }

        // if (request('id')) {
        //     $message = \Lang::get('admin/shirts.shirtTissue-update');
        // } else {
        //     $message = \Lang::get('admin/shirts.shirtTissue-create');
        // }


        // $view = View::make('admin.shirts.index')
        //     ->with('shirtTissue', $this->shirtTissue)
        //     ->with('shirts', $paginate);

        // $sections = $view->renderSections();

        // return response()->json([
        //     'table' => $sections['table'],
        //     'tablerows' => $sections['tablerows'],
        //     'form' => $sections['form'],
        // ]);
    }


}