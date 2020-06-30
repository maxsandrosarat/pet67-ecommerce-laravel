<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $clientes = User::paginate(20);
        return view('cadastros.clientes',compact('clientes'));
    }

    public function filtro(Request $request)
    {
        $nome = $request->input('nome');
        $email = $request->input('email');
        if(isset($nome)){
            if(isset($email)){
                $clientes = User::where('name','like',"%$nome%")->where('email','like',"%$email%")->paginate(100);
            } else {
                $clientes = User::where('name','like',"%$nome%")->paginate(100);
            }
        } else {
            if(isset($email)){
                $clientes = User::where('email','like',"%$email%")->paginate(100);
            } else {
                return redirect('/admin/clientes');
            }
        }
        
        return view('cadastros.clientes',compact('clientes'));
    }
}
