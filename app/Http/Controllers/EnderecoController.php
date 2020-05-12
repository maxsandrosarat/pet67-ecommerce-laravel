<?php

namespace App\Http\Controllers;

use App\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnderecoController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $enderecos = Endereco::where([
            'user_id'  => "$userId"
            ])->get();
        return view('cliente.enderecos', compact('enderecos'));
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $endereco = new Endereco();
        $endereco->user_id = $userId;
        $endereco->rua = $request->input('rua');
        $endereco->numero = $request->input('numero');
        $endereco->complemento = $request->input('complemento');
        $endereco->bairro = $request->input('bairro');
        $endereco->cidade = $request->input('cidade');
        $endereco->uf = $request->input('uf');
        $endereco->tipo = $request->input('tipo');
        $endereco->save();
        return back();
    }

    public function destroy($id)
    {
        $endereco = Endereco::find($id);
        if(isset($endereco)){
            $endereco->delete();
        }
        return back();
    }
}
