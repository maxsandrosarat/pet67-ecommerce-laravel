<?php

namespace App\Http\Controllers;

use App\FormaPagamento;
use Illuminate\Http\Request;

class FormaPagamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $formas = FormaPagamento::all();
        return view('cadastros.formas_pagamento',compact('formas'));
    }

    public function store(Request $request)
    {
        $forma = new FormaPagamento();
        $forma->descricao = $request->input('descricao');
        $forma->save();
        return back();
    }

    public function update(Request $request, $id)
    {
        $forma = FormaPagamento::find($id);
        if(isset($forma)){
            $forma->descricao = $request->input('descricao');
            $forma->ativo = $request->input('ativo');
            $forma->save();
        }
        return back();
    }

    public function destroy($id)
    {
        $forma = FormaPagamento::find($id);
        if(isset($forma)){
            $forma->ativo = false;
            $forma->save();
        }
        return back();
    }
}
