<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $cats = Categoria::all();
        return view('cadastros.categorias',compact('cats'));
    }

    public function store(Request $request)
    {
        $cat = new Categoria();
        $cat->nome = $request->input('nomeCategoria');
        $cat->save();
        return back();
    }

    public function update(Request $request, $id)
    {
        $cat = Categoria::find($id);
        if(isset($cat)){
            $cat->nome = $request->input('nomeCategoria');
            $cat->ativo = $request->input('ativo');
            $cat->save();
        }
        return back();
    }

    public function destroy($id)
    {
        $cat = Categoria::find($id);
        if(isset($cat)){
            $cat->ativo = false;
            $cat->save();
        }
        return back();
    }
}
