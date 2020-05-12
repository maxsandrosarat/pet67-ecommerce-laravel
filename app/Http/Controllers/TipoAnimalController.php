<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoAnimal;

class TipoAnimalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $tipos = TipoAnimal::all();
        return view('cadastros.tipos_animais',compact('tipos'));
    }

    public function store(Request $request)
    {
        $tipo = new TipoAnimal();
        $tipo->nome = $request->input('nome');
        $tipo->save();
        return back();
    }

    public function update(Request $request, $id)
    {
        $tipo = TipoAnimal::find($id);
        if(isset($tipo)){
            $tipo->nome = $request->input('nome');
            $tipo->save();
        }
        return back();
    }

    public function destroy($id)
    {
        $tipo = TipoAnimal::find($id);
        if(isset($tipo)){
            $tipo->delete();
        }
        return back();
    }
}
