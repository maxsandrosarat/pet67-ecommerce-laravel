<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\PedidoProduto;
use App\Produto;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.home');
    }

    public function cadastros(){
        return view('cadastros.home_cadastros');
    }

    public function pedidos(){
        return view('admin.home_pedidos');
    }

    public function pedidos_feitos()
    {
        $pedidos = Pedido::where([
            'status'  => 'FEITO',
            ])->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pedidos_feitos', compact('pedidos'));
    }

    public function pedidos_pagos()
    {
        $pedidos = Pedido::where([
            'status'  => 'PAGO',
            ])->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pedidos_pagos', compact('pedidos'));
    }

    public function pedidos_cancelados()
    {
        $cancelados = Pedido::where([
            'status'  => 'CANCEL'
            ])->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.pedidos_cancelados', compact('cancelados'));
    }

    public function pagar_pedido($id){
        $pedido = Pedido::find($id);
        $pedido->status = 'PAGO';
        $pedido->update();
        $pedido_produtos = PedidoProduto::where('pedido_id',"$id")->get();
        foreach($pedido_produtos as $produtos){
            if($produtos->status == 'CANCEL'){

            } else {
                $produtos->status = 'PAGO';
                $produtos->update();
                $produto = Produto::find($produtos->produto_id);
                $produto->estoque -= 1;
                $produto->update();
            }
        }
        return back()->with('mensagem-sucesso', 'Pedido pago com sucesso!');
    }

    public function cancelar_pedido($id){
        $pedido = Pedido::find($id);
        $pedido->status = 'CANCEL';
        $pedido->update();
        $pedido_produtos = PedidoProduto::where('pedido_id',"$id")->get();
        foreach($pedido_produtos as $produtos){
            if($produtos->status == 'PAGO'){
                $produto = Produto::find($produtos->produto_id);
                $produto->estoque += 1;
            }
            $produtos->status = 'CANCEL';
            $produtos->update();
        }
        return back()->with('mensagem-sucesso', 'Pedido cancelado com sucesso!');
    }
}
