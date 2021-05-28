<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\Manager;
use App\Http\Controllers\Controller;
use App\Vendor\Locale\Models\LocaleLanguage;
use App\Vendor\Locale\Models\LocaleTag;
use Debugbar;


class LocaleTagController extends Controller
{
    protected $agent;
    protected $locale_tag;
    protected $language;
    protected $manager;
    protected $paginate;

    function __construct(Agent $agent, LocaleTag $locale_tag, LocaleLanguage $language, Manager $manager)
    {
        $this->middleware('auth');
        $this->agent = $agent;
        $this->locale_tag = $locale_tag;
        $this->language = $language;
        $this->manager = $manager;
        $this->locale_tag->active = 1;

        if ($this->agent->isMobile()) {
            $this->paginate = 10;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 6;
        }
    }

    public function index()
    {
        $tags = $this->locale_tag
            ->select('group', 'key')
            ->groupBy('group', 'key')
            ->where('group', 'not like', 'admin/%')
            ->where('group', 'not like', 'front/seo')
            ->paginate($this->paginate);

        $view = View::make('admin.tags.index')
            ->with('tags',  $tags)
            ->with('tag', $this->locale_tag);

        if (request()->ajax()) {

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
    }

    public function store(Request $request)
    {

        foreach (request('tag') as $keyLanguage => $valueLanguage) {

            DebugBar::info($valueLanguage['value']);

            $locale_tag = $this->locale_tag::updateOrCreate(
                [
                    'id' => $valueLanguage['id']
                ],
                [
                    'value' => $valueLanguage['value'],
                    'active' => 1
                ]
            );
        }

        $this->manager->exportTranslations(request('group'));

        $tags = $this->locale_tag
            ->select('group', 'key')
            ->groupBy('group', 'key')
            ->where('group', 'not like', 'admin/%')
            ->where('group', 'not like', 'front/seo')
            ->paginate($this->paginate);

        $message = \Lang::get('admin/tags.tag-update');

        $view = View::make('admin.tags.index')
            ->with('tags', $tags)
            ->with('tag', $this->locale_tag)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message,
        ]);
    }

    public function show(Request $request, $groupKey = null)
    {

        $groupKey = json_decode($request->input('groupKey'));

        $tags = $this->locale_tag->where('group', $groupKey->group)->where('key', $groupKey->key)->paginate($this->paginate)
            ->appends(['groupKey' => json_encode($groupKey)]);

        $locale = null;

        $locale['group'] = $groupKey->group;

        foreach ($tags as $tag) {
            $locale['value.' . $tag->language] = empty($tag->value) ? '' : $tag->value;
            $locale['id.' . $tag->language] = empty($tag->id) ? '' : $tag->id;
        }

        $view = View::make('admin.tags.index')
            ->with('locale', $locale)
            ->with('tags', $tags);

        Debugbar::info($locale);

        if (request()->ajax()) {
            $sections = $view->renderSections();

            return response()->json([
                'layout' => $sections['content'],
                'form' => $sections['form'],
                'tablerows' => $sections['tablerows'],
            ]);
        }

        return $view;
    }

   public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));
        
        $query = $this->locale_tag->query();

        if($filters != null){

            $query->when($filters->parent, function ($q, $parent) {

                if($parent == 'all'){
                    return $q;
                }
                else{
                    return $q->where('group', $parent);
                }
            });
    
            $query->when($filters->order, function ($q, $order) use ($filters) {
                if($order == 'default'){
                    $order = 'group';
                }

                $order_asc_desc = ($filters->order_asc_desc == "desc") ? "desc" : "asc";

                $q->orderBy($order, $order_asc_desc);

            });
        }
    
        $tags = $query->select('group', 'key')
                ->groupBy('group', 'key')
                ->where('group', 'not like', 'admin/%')
                ->where('group', 'not like', 'front/seo')
                ->paginate($this->paginate)
                ->appends(['filters' => json_encode($filters)]);  

        $view = View::make('admin.tags.index')
            ->with('tags', $tags)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }

    public function importTags()
    {
        $this->manager->importTranslations();  
        $message =  \Lang::get('admin/tags.tag-import');

        $tags = $this->locale_tag
        ->select('group', 'key')
        ->groupBy('group', 'key')
        ->where('group', 'not like', 'admin/%')
        ->where('group', 'not like', 'front/seo')
        ->paginate($this->paginate);  

        $view = View::make('admin.tags.index')
            ->with('tags', $tags)
            ->with('tag', $this->locale_tag);

        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'message' => $message,
            ]); 
        }
    }
}
