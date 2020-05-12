<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;

class MarcaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $marcas = Marca::all();
        return view('cadastros.marcas',compact('marcas'));
    }

    public function store(Request $request)
    {
        $marca = new Marca();
        $marca->nome = $request->input('nome');
        $marca->save();
        return back();
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::find($id);
        if(isset($marca)){
            $marca->nome = $request->input('nome');
            $marca->save();
        }
        return back();
    }

    public function destroy($id)
    {
        $marca = Marca::find($id);
        if(isset($marca)){
            $marca->delete();
        }
        return back();
    }
}
