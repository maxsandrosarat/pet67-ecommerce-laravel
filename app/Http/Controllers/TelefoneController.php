<?php

namespace App\Http\Controllers;

use App\ClienteTelefone;
use App\Telefone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TelefoneController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $clienteTelefones = ClienteTelefone::where([
            'user_id'  => "$userId"
            ])->get();
        return view('cliente.telefones', compact('clienteTelefones'));
    }

    public function store(Request $request)
    {
        $telefone = new Telefone();
        $telefone->numero = $request->input('numero');
        $telefone->tipo = $request->input('tipo');
        $telefone->save();

        $userId = Auth::user()->id;
        $clienteTelefone = new ClienteTelefone();
        $clienteTelefone->user_id = $userId;
        $clienteTelefone->telefone_id = $telefone->id;
        $clienteTelefone->save();

        return back();
    }

    public function destroy($id)
    {
        $telefone = Telefone::find($id);
        if(isset($telefone)){
            $telefone->ativo = false;
            $telefone->save();
        }
        return back();
    }
}
