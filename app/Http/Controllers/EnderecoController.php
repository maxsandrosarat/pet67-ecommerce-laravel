<?php

namespace App\Http\Controllers;

use App\ClienteEndereco;
use App\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnderecoController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $clienteEnderecos = ClienteEndereco::where([
            'user_id'  => "$userId"
            ])->get();
        return view('cliente.enderecos', compact('clienteEnderecos'));
    }

    public function store(Request $request)
    {
        $endereco = new Endereco();
        $endereco->cep = $request->input('cep');
        $endereco->rua = $request->input('rua');
        $endereco->numero = $request->input('numero');
        $endereco->complemento = $request->input('complemento');
        $endereco->bairro = $request->input('bairro');
        $endereco->cidade = $request->input('cidade');
        $endereco->uf = $request->input('uf');
        $endereco->tipo = $request->input('tipo');
        $endereco->save();

        $userId = Auth::user()->id;
        $clienteEndereco = new ClienteEndereco();
        $clienteEndereco->user_id = $userId;
        $clienteEndereco->endereco_id = $endereco->id;
        $clienteEndereco->save();

        return back();
    }

    public function destroy($id)
    {
        $endereco = Endereco::find($id);
        if(isset($endereco)){
            $endereco->ativo = false;
            $endereco->save();
        }
        return back();
    }
}
