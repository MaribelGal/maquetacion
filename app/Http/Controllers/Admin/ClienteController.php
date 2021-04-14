<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClienteRequest;
use App\Models\DB\Cliente;

class ClienteController extends Controller
{
    protected $cliente;

    function __construct(Cliente $cliente)
    {
        $this->middleware('auth');
        $this->cliente = $cliente;
    }

    public function index()
    {

        $view = View::make('admin.clientes.index')
            ->with('cliente', $this->cliente)
            ->with('clientes', $this->cliente->where('active', 1)->get());


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

        $view = View::make('admin.clientes.index')
            ->with('cliente', $this->cliente)
            ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(ClienteRequest $request)
    {
        $cliente = $this->cliente->updateOrCreate([
            'id' => request('id')
        ], [
            'nif' => request('nif'),
            'nombre' => request('nombre'),
            'telefono' => request('telefono'),
            'correo' => request('correo'),
            'cp' => request('cp'),
            'direccion' => request('direccion'),
            'poblacion' => request('poblacion'),
            'provincia' => request('provincia'),
            'pais' => request('pais'),
            'active' => 1,
        ]);

        $view = View::make('admin.clientes.index')
            ->with('clientes', $this->cliente->where('active', 1)->get())
            ->with('cliente', $cliente)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $cliente->id,
        ]);

        $request->messages();
    }

    public function show(Cliente $cliente)
    {
        $view = View::make('admin.clientes.index')
            ->with('cliente', $cliente)
            ->with('clientes', $this->cliente->where('active', 1)->get());

        if (request()->ajax()) {

            $sections = $view->renderSections();

            return response()->json([
                'form' => $sections['form'],
                'table' => $sections['table']
            ]);
        }

        return $view;
    }



    public function destroy(Cliente $cliente)
    {
        $cliente->active = 0;
        $cliente->save();

        $view = View::make('admin.clientes.index')
            ->with('cliente', $this->cliente)
            ->with('clientes', $this->cliente->where('active', 1)->get())
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }
}
//-----------------------------------------------------------------------------