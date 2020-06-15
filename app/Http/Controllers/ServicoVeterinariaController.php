<?php

namespace App\Http\Controllers;

use App\ServicoVeterinaria;
use Illuminate\Http\Request;

class ServicoVeterinariaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $servs = ServicoVeterinaria::all();
        return view('cadastros.servicos_veterinaria',compact('servs'));
    }

    public function store(Request $request)
    {
        $serv = new ServicoVeterinaria();
        $serv->nome = $request->input('nome');
        $serv->preco = $request->input('preco');
        $serv->descricao = $request->input('descricao');
        $serv->save();
        return back();
    }

    public function update(Request $request, $id)
    {
        $serv = ServicoVeterinaria::find($id);
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
        $serv = ServicoVeterinaria::find($id);
        if(isset($serv)){
            $serv->delete();
        }
        return back();
    }
}
