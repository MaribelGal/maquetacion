<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\DB\Faq;
use \Debugbar;

class FaqController extends Controller
{
    protected $faq;
    protected $paginationNum;

    function __construct(Faq $faq)
    {
        $this->middleware('auth');
        $this->faq = $faq;
        $this->paginationNum = 6;
    }

    public function index()
    {

        $paginate = $this->faq->where('active', 1)->paginate($this->paginationNum);
        
        $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $paginate);
        
        // $paginate->withPath('/admin/faqs');


        if (request()->ajax()) {

            $sections = $view->renderSections();

            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]);
        }

        return $view;
    }

    public function indexJson()
    {
        if (!Auth::guard('web')->user()->canAtLeast(['faqs'])) {
            return Auth::guard('web')->user()->redirectPermittedSection();
        }

        $query = $this->faq
            ->with('category')
            ->select('t_faq.*');

        return $this->datatables->of($query)->toJson();
    }

    public function create()
    {

        $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(FaqRequest $request)
    {
        $faq = $this->faq->updateOrCreate([
            'id' => request('id')
        ], [
            'titulo' => request('titulo'), //name del input
            'visible' => request('visible'),
            'description' => request('description'),
            'category_id' => request('category_id'),
            'active' => 1,
        ]);

        $view = View::make('admin.faqs.index')
            ->with('faqs', $this->faq->where('active', 1)->paginate($this->paginationNum))
            ->with('faq', $faq)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $faq->id,
        ]);

        $request->messages();
    }

    public function show(Faq $faq)
    {
        $view = View::make('admin.faqs.index')
            ->with('faq', $faq)
            ->with('faqs', $this->faq->where('active', 1)->paginate($this->paginationNum));

        if (request()->ajax()) {

            $sections = $view->renderSections();

            return response()->json([
                'form' => $sections['form'],
                'table' => $sections['table']
            ]);
        }

        return $view;
    }



    public function destroy(Faq $faq)
    {
        $faq->active = 0;
        $faq->save();

        $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $this->faq->where('active', 1)->paginate($this->paginationNum))
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }

    public function reorderTable(Request $request)
    {
        $order = request('order');

        if (is_array($order)) {

            foreach ($order as $index => $tableItem) {
                $item = $this->faq->findOrFail($tableItem);
                $item->order = $index + 1;
                $item->save();
            }
        }
    }


    public function filter(Request $request)
    {

        $query = $this->faq->query();

        $query->where('t_faqs.active', 1);

        $query->when(request('category_id'), function ($q, $category_id) {

            if ($category_id == 'all') {
                return $q;
            } else {
                return $q->where('category_id', $category_id);
            }
        });

        $query->when(request('search'), function ($q, $search) {

            if ($search == null) {
                return $q;
            } else {
                return $q->where('titulo', 'like', "%$search%");
            }
        });

        $query->when(request('date_start'), function ($q, $date_start) {

            if ($date_start == null) {
                return $q;
            } else {
                return $q->whereDate('created_at', '>=', date($date_start));
            }
        });

        $query->when(request('date_end'), function ($q, $date_end) {

            if ($date_end == null) {
                return $q;
            } else {
                return $q->whereDate('created_at', '<=', date($date_end));
            }
        });

        $query->when(request('order'), function ($q, $order)  {
            
            $order_asc_desc = (request('order_asc_desc') == "desc") ? "desc" : "asc";
    
            if($order == "category_id"){
                $q->join('t_faq_categories', 't_faqs.category_id', '=', 't_faq_categories.id')
                ->where('t_faqs.active',1);
            }

            return $q->orderBy($order,  $order_asc_desc);

        });


        $faqs = $query->paginate($this->paginationNum);

        $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $faqs)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }
}
