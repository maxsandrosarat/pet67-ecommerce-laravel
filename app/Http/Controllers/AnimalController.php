<?php

namespace App\Http\Controllers;

use App\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $animais = Animal::all();
        return view('cadastros.animais',compact('animais'));
    }

    public function store(Request $request)
    {
        $animal = new Animal();
        if($request->file('foto')!=""){
            $path = $request->file('foto')->store('fotos_animais','public');
            $animal->foto = $path;
        }
        if($request->input('nome')!=""){
            $animal->nome = $request->input('nome');
        }
        if($request->input('descricao')!=""){
            $animal->descricao = $request->input('descricao');
        }
        if($request->input('preco')!=""){
            $animal->preco = $request->input('preco');
        }
        if($request->input('ativo')!=""){
            $animal->ativo = $request->input('ativo');
        }
        $animal->save();
        return back();
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::find($id);
        if(isset($animal)){
            if($request->file('foto')!=""){
                Storage::disk('public')->delete($animal->foto);
                $path = $request->file('foto')->store('fotos_animais','public');
                $animal->foto = $path;
            }
            if($request->input('nome')!=""){
                $animal->nome = $request->input('nome');
            }
            if($request->input('descricao')!=""){
                $animal->descricao = $request->input('descricao');
            }
            if($request->input('preco')!=""){
                $animal->preco = $request->input('preco');
            }
            if($request->input('ativo')!=""){
                $animal->ativo = $request->input('ativo');
            }
            $animal->save();
        }
        return back();
    }

    public function destroy($id)
    {
        $animal = Animal::find($id);
        if(isset($animal)){
            Storage::disk('public')->delete($animal->foto);
            $animal->delete();
        }
        return back();
    }
}
