<?php

namespace App\Http\Controllers;

use App\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnuncioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $anuncios = Anuncio::all();
        return view('cadastros.anuncios',compact('anuncios'));
    }

    public function store(Request $request)
    {
        $anuncio = new Anuncio();
        if($request->file('foto')!=""){
            $path = $request->file('foto')->store('fotos_anuncios','public');
            $anuncio->foto = $path;
        }
        $anuncio->nome = $request->input('nome');
        $anuncio->ativo = $request->input('ativo');
        $anuncio->link = $request->input('link');
        $anuncio->save();
        return back();
    }

    public function update(Request $request, $id)
    {
        $anuncio = Anuncio::find($id);
        if($request->file('foto')!=""){
            Storage::disk('public')->delete($anuncio->foto);
            $path = $request->file('foto')->store('fotos_anuncios','public');
            $anuncio->foto = $path;
        }
        if($request->input('nome')!=""){
            $anuncio->nome = $request->input('nome');
        }
        if($request->input('ativo')!=""){
            $anuncio->ativo = $request->input('ativo');
        }
        if($request->input('link')!=""){
            $anuncio->link = $request->input('link');
        }
        $anuncio->save();
        return back();
    }

    public function destroy($id)
    {
        $anuncio = Anuncio::find($id);
        if(isset($anuncio)){
            Storage::disk('public')->delete($anuncio->foto);
            $anuncio->delete();
        }
        return back();
    }
}
