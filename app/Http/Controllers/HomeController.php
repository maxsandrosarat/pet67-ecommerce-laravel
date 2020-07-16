<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('/');
    }

    public function meuPerfil(){
        return view('auth.register-edit');
    }

    public function meuPerfilEdit(Request $request)
    {
        $adm = User::find(Auth::user()->id);
        if(isset($adm)){
            if($request->input('name')!=""){
                $adm->name = $request->input('name');
            }
            if($request->input('email')!=""){
                $adm->email = $request->input('email');
            }
            if($request->input('password')!=""){
                $adm->password = Hash::make($request->input('password'));
            }
            $adm->save();
            return back()->with('mensagem', 'Perfil atualizado com Sucesso!');
        } else {
            return back()->with('mensagem', 'Perfil não encontrado!');
        }
    }
}
