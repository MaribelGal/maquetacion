<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
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

        $view = View::make('front.faqs.index')
        ->with('faq', $this->faq)
        ->with('faqs', $this->faq->where('active', 1)->get());
        

        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }

        return $view;
    }
}