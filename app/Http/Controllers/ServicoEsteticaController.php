<?php

namespace App\Http\Controllers;

use App\ServicoEstetica;
use Illuminate\Http\Request;

class ServicoEsteticaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $servs = ServicoEstetica::all();
        return view('cadastros.servicos_estetica',compact('servs'));
    }

    public function store(Request $request)
    {
        $serv = new ServicoEstetica();
        $serv->nome = $request->input('nome');
        $serv->preco = $request->input('preco');
        $serv->descricao = $request->input('descricao');
        $serv->save();
        return back();
    }

    public function update(Request $request, $id)
    {
        $serv = ServicoEstetica::find($id);
        if(isset($serv)){
            $serv->nome = $request->input('nome');
            $serv->preco = $request->input('preco');
            $serv->descricao = $request->input('descricao');
            $serv->save();
        }
        return back();
    }

    public function destroy($id)
    {
        $serv = ServicoEstetica::find($id);
        if(isset($serv)){
            $serv->delete();
        }
        return back();
    }
}
