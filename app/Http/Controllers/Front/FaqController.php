<?php

namespace App\Http\Controllers\Front;

use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Vendor\Locale\Locale;
use Debugbar;
use App\Models\DB\Faq;
use Jenssegers\Agent\Agent;

class FaqController extends Controller
{
    protected $faq;
    protected $agent;
    protected $grid;

    function __construct(Faq $faq, Agent $agent)
    {
        $this->faq = $faq;
        $this->agent = $agent;
    }

    public function index()
    {
        $faqs = $this->faq->where('active', 1)->where('visible', 1)->get();

        $faqs = $faqs->each(function($faq) {  
            
            $faq['locale'] = $faq->locale->pluck('value','tag');
            
            // $faq['images_featured'] = $faq->images->where('content', 'featured')->pluck('path', 'grid');
            
            if ($this->agent->isMobile()) {
                $imagesInfo['path_mobile']=$faq->images->where('grid', 'mobile')->pluck('path', 'content');
            }

            if ($this->agent->isDesktop()) {
                $imagesInfo['path_desktop']=$faq->images->where('grid', 'desktop')->pluck('path', 'content');
            }
            
            $imagesInfo['path_preview']=$faq->images->where('grid', 'preview')->pluck('path', 'content');
            // $imagesInfo['alt']=$faq->images->pluck('path', 'content');

            $faq['images'] = $imagesInfo;
            return $faq;
        });
        debugbar::info($faqs);

        $view = View::make('front.faqs.index')
            ->with('faqs', $faqs);

        return $view;
    }
}
