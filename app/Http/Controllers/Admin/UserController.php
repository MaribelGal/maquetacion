<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\DB\User;

class UserController extends Controller
{
    protected $user;

    function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index()
    {

        $view = View::make('admin.users.index')
        ->with('user', $this->user)
        ->with('users', $this->user->where('active', 1)->get());
        

        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }

        return $view;
    }

    // public function indexJson()
    // {
    //     if (! Auth::guard('web')->user()->canAtLeast(['users'])){
    //         return Auth::guard('web')->user()->redirectPermittedSection();
    //     }

    //     $query = $this->user
    //     ->with('category')
    //     ->select('user.*');

    //     return $this->datatables->of($query)->toJson();   
    // }

    public function create()
    {

        $view = View::make('admin.users.index')
        ->with('user', $this->user)
        ->renderSections();
 
        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(UserRequest $request)
    {    
        if (request('password') == null) {
            $user = $this->user->updateOrCreate([
                'id' => request('id')],[
                'name' => request('name'), 
                'email' => request('email'),
                //'remember_token' => request('remember_token'),
                'active' => 1,
            ]);
        } else {
            $user = $this->user->updateOrCreate([
                'id' => request('id')],[
                'name' => request('name'), 
                'email' => request('email'),
                'password' =>  bcrypt(request('password')),
                //'remember_token' => request('remember_token'),
                'active' => 1,
            ]);
        }
        
        
        

        $view = View::make('admin.users.index')
        ->with('users', $this->user->where('active', 1)->get())
        ->with('user', $user)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $user->id,
        ]);

        $request->messages();
    }

    public function show(User $user)
    {
        $view = View::make('admin.users.index')
        ->with('user', $user)
        ->with('users', $this->user->where('active', 1)->get());   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
                'table' => $sections['table']
            ]); 
        }
                
        return $view;
    }
    


    public function destroy(User $user)
    { 
        $user->active = 0; 
        $user->save();

        $view = View::make('admin.users.index')
            ->with('user', $this->user)
            ->with('users', $this->user->where('active', 1)->get())
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }

    // public function reorderTable(Request $request)
    // {
    //     $order = request('order');

    //     if (is_array($order)) {
            
    //         foreach ($order as $index => $tableItem) {
    //             $item = $this->user->findOrFail($tableItem);
    //             $item->order = $index + 1;
    //             $item->save();
    //         }
    //     }
    // }
}
