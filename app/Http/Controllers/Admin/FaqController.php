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
use Jenssegers\Agent\Agent;

class FaqController extends Controller
{
    protected $faq;
    protected $agent;
    protected $paginationNum;

    function __construct(Faq $faq, Agent $agent)
    {
        $this->middleware('auth');
        $this->faq = $faq;
        $this->agent = $agent;

        if ($this->agent->isMobile()) {
            $this->paginationNum = 6;
        }

        if ($this->agent->isDesktop()) {
            $this->paginationNum = 3;
        }
    }

    public function index()
    {

        $paginate = $this->faq->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum);

        $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $paginate);

        // $paginate->withPath('/admin/faqs');


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

        if (request('id')) {
            $message = \Lang::get('admin/faqs.faq-update');
        } else {
            $message = \Lang::get('admin/faqs.faq-create');
        }


        $view = View::make('admin.faqs.index')
            ->with('faqs', $this->faq->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum))
            ->with('faq', $faq)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'tablerows' => $view['tablerows'],
            'form' => $view['form'],
            'message' => $message,
            'id' => $faq->id,
        ]);

        // $request->messages();
    }

    public function show(Faq $faq)
    {
        $view = View::make('admin.faqs.index')
            ->with('faq', $faq)
            ->with('faqs', $this->faq->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum));

        if (request()->ajax()) {

            $sections = $view->renderSections();

            return response()->json([
                'form' => $sections['form'],
                'table' => $sections['table'],
                'tablerows' => $sections['tablerows'],
            ]);
        }

        return $view;
    }



    public function destroy(Faq $faq)
    {
        $faq->active = 0;
        $faq->save();

        $message = \Lang::get('admin/faqs.faq-delete');

        $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with(
                'faqs', 
                $this->faq->where('active', 1)
                          ->orderBy('updated_at', 'desc')
                          ->paginate($this->paginationNum))
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'tablerows' => $view['tablerows'],
            'form' => $view['form'],
            'message' => $message
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


    public function filter(Request $request, $filters = null)
    {
        $filters = json_decode($request->input('filters'));

        $query = $this->faq->query();

        $query->where('t_faqs.active', 1);

        if ($filters != null) {

            $query->when($filters->category_id, function ($q, $category_id) {

                if ($category_id == 'all') {
                    return $q;
                } else {
                    return $q->where('category_id', $category_id);
                }
            });

            $query->when($filters->search, function ($q, $search) {

                if ($search == null) {
                    return $q;
                } else {
                    return $q->where('t_faqs.titulo', 'like', "%$search%");
                }
            });

            $query->when($filters->date_start, function ($q, $date_start) {

                if ($date_start == null) {
                    return $q;
                } else {
                    return $q->whereDate('t_faqs.created_at', '>=', date($date_start));
                }
            });

            $query->when($filters->date_end, function ($q, $date_end) {

                if ($date_end == null) {
                    return $q;
                } else {
                    return $q->whereDate('t_faqs.created_at', '<=', date($date_end));
                }
            });

            $query->when($filters->order, function ($q, $order) use ($filters) {

                $order_asc_desc = ($filters->order_asc_desc == "desc") ? "desc" : "asc";

                if ($order == "category_id") {
                    $q->join('t_faq_categories', 't_faqs.category_id', '=', 't_faq_categories.id')
                        ->where('t_faqs.active', 1);
                }

                return $q->orderBy($order,  $order_asc_desc);
            });
        }

        $faqs = $query
            ->paginate($this->paginationNum)
            ->appends(['filters' => json_encode($filters)]);

        $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $faqs)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'tablerows' => $view['tablerows'],
        ]);
    }
}
