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

class FaqController extends Controller
{
    protected $faq;

    function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    public function index()
    {

        
        $faqs = $this->faq->where('active', 1)->where('visible', 1)->get();

        $faqs = $faqs->each(function($faq) {  
            
            $faq['locale'] = $faq->locale->pluck('value','tag');
            $faq['images'] = $faq->images->where('grid', 'preview')->where('content', 'featured');
            return $faq;
        });
    
        debugbar::info($faqs);

        $view = View::make('front.faqs.index')
            ->with('faqs', $faqs);

        return $view;
    }
}
