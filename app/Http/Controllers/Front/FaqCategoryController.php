<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqCategoryRequest;
use App\Models\DB\FaqCategory;

class FaqCategoryController extends Controller
{
    protected $faqCategory;

    function __construct(FaqCategory $faqCategory)
    {
        $this->faqCategory = $faqCategory;
    }

    public function index()
    {

        $view = View::make('admin.faq_categories.index')
        ->with('faqCategory', $this->faqCategory)
        ->with('faq_categories', $this->faqCategory->where('active', 1)->get());
        

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