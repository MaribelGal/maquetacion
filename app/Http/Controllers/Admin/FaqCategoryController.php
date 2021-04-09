<?php

namespace App\Http\Controllers\Admin;

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

        $view = View::make('admin.faqs_categories.index')
        ->with('faqCategory', $this->faqCategory)
        ->with('faqCategories', $this->faqCategory->where('active', 1)->get());
        

        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }

        return $view;
    }


    public function create()
    {

        $view = View::make('admin.faqs_categories.index')
        ->with('faqCategory', $this->faqCategory)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(FaqCategoryRequest $request)
    {   
        $faqCategory = $this->faqCategory->updateOrCreate([
            'id' => request('id')],[
            'nombre' => request('nombre'), //name del input
            'active' => 1,
        ]); 

        $view = View::make('admin.faqs_categories.index')
        
        ->with('faqCategories', $this->faqCategory->where('active', 1)->get())
        ->with('faqCategory', $faqCategory)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $faqCategory->id,
        ]);

        $request->messages();
    }

    public function show(FaqCategory $faqs_categoria)
    {
        $view = View::make('admin.faqs_categories.index')
        ->with('faqCategory', $faqs_categoria)
        ->with('faqCategories', $this->faqCategory->where('active', 1)->get());   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
                'table' => $sections['table']
            ]); 
        }
                
        return $view;
    }
    


    public function destroy(FaqCategory $faqs_categoria)
    {
        $faqs_categoria->active = 0;
        $faqs_categoria->save();

        $view = View::make('admin.faqs_categories.index')
            ->with('faqCategory', $this->faqCategory)
            ->with('faqCategories', $this->faqCategory->where('active', 1)->get())
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }

    
}
