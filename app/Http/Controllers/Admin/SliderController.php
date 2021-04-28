<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\DB\Slider;
use \Debugbar;
use Jenssegers\Agent\Agent;

class SliderController extends Controller
{
    protected $slider;
    protected $agent;
    protected $paginationNum;

    function __construct(Slider $slider, Agent $agent)
    {
        $this->middleware('auth');
        $this->slider = $slider;
        $this->agent = $agent;

        if($this->agent->isMobile()){
            $this->paginationNum = 6;
        }

        if($this->agent->isDesktop()){
            $this->paginationNum = 10;
        }
    }

    public function index()
    {

        $paginate = $this->slider->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum);
        
        $view = View::make('admin.sliders.index')
            ->with('slider', $this->slider)
            ->with('sliders', $paginate);


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


    public function create()
    {

        $view = View::make('admin.sliders.index')
            ->with('slider', $this->slider)
            ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(SliderRequest $request)
    {
        $slider = $this->slider->updateOrCreate([
            'id' => request('id')
        ], [
            'name' => request('name'), 
            'entity' => request('entity'),
            'visible' => request('visible'),
            'active' => 1,
        ]);

        if (request('id')){
            $message = \Lang::get('admin/sliders.slider-update');
        }else{
            $message = \Lang::get('admin/sliders.slider-create');
        }


        $view = View::make('admin.sliders.index')
            ->with('sliders', $this->slider->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum))
            ->with('slider', $slider)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'tablerows' => $view['tablerows'],
            'form' => $view['form'],
            'message' => $message,
            'id' => $slider->id,
        ]);

        // $request->messages();
    }

    public function show(Slider $slider)
    {
        $view = View::make('admin.sliders.index')
            ->with('slider', $slider)
            ->with('sliders', $this->slider->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum));

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

    public function destroy(Slider $slider)
    {
        $slider->active = 0;
        $slider->save();

        $message = \Lang::get('admin/sliders.slider-delete');

        $view = View::make('admin.sliders.index')
            ->with('slider', $this->slider)
            ->with('sliders', $this->slider->where('active', 1)->orderBy('updated_at', 'desc')->paginate($this->paginationNum))
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'tablerows' => $view['tablerows'],
            'form' => $view['form'],
            'message' => $message
        ]);
    }


    public function filter(Request $request)
    {

        $query = $this->slider->query();

        $query->where('t_sliders.active', 1);
        
        $query->when(request('search'), function ($q, $search) {

            if ($search == null) {
                return $q;
            } else {
                return $q->where('name', 'like', "%$search%");
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

            return $q->orderBy($order,  $order_asc_desc);

        });


        $sliders = $query->paginate($this->paginationNum);

        $view = View::make('admin.sliders.index')
            ->with('slider', $this->slider)
            ->with('sliders', $sliders)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'tablerows' => $view['tablerows'],
        ]);
    }
}
