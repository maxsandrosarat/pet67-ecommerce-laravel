<?php

namespace App\Http\Controllers;

use App\Entrega;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $formas = Entrega::all();
        return view('cadastros.entregas',compact('formas'));
    }

    public function store(Request $request)
    {
        $forma = new Entrega();
        $forma->descricao = $request->input('descricao');
        $forma->valor = $request->input('valor');
        $forma->save();
        return back();
    }

    public function update(Request $request, $id)
    {
        $forma = Entrega::find($id);
        if(isset($forma)){
            $forma->descricao = $request->input('descricao');
            $forma->valor = $request->input('valor');
            $forma->ativo = $request->input('ativo');
            $forma->save();
        }
        return back();
    }

    public function destroy($id)
    {
        $forma = Entrega::find($id);
        if(isset($forma)){
            $forma->ativo = false;
            $forma->save();
        }
        return back();
    }
}
