<?php

namespace App\Http\Controllers;

use App\Admin;
use App\EntradaSaida;
use App\Pedido;
use App\PedidoProduto;
use App\Produto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.home');
    }

    public function meuPerfil(){
        return view('auth.admin-register-edit');
    }

    public function meuPerfilEdit(Request $request)
    {
        $adm = Admin::find(Auth::user()->id);
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

    public function cadastros(){
        return view('cadastros.home_cadastros');
    }

    public function cadastroAdmin()
    {
        return view('auth.admin-register');
    }

    public function novoAdmin(Request $request)
    {
        $adm = new Admin();
        $adm->name = $request->input('name');
        $adm->email = $request->input('email');
        $adm->password = Hash::make($request->input('password'));
        $adm->save();
        return back()->with('mensagem', 'Novo Administrador(a) cadastrado com Sucesso!');
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

    public function pedidos_reservados()
    {
        $rels = PedidoProduto::where('status','RESERV')->orderBy('created_at','desc')->orderBy('id','desc')->get();
        return view('admin.pedidos_reservados', compact('rels'));
    }

    public function liberar_produto_reservado($id)
    {
        $pedProd = PedidoProduto::find($id);
        $ped = Pedido::find($pedProd->pedido_id);
        $ped->update([
            'status' => 'CANCEL',
            'total' => 0
        ]);
        PedidoProduto::where('pedido_id',"$ped->id")->update([
            'status' => 'CANCEL',
            'qtdGranel' => 0,
            'valor' => 0,
            'desconto' => 0
        ]);
        $produtos = PedidoProduto::where('pedido_id',"$ped->id")->get();
        foreach ($produtos as $prods) {
            $prod = Produto::find($prods->produto_id);
                if(isset($prod)){
                    if($prod->granel==1){

                    } else {
                        $user = Auth::user();
                        $es = new EntradaSaida();
                        $es->tipo = "entrada";
                        $es->produto_id = $prods->produto_id;
                        $es->quantidade = 1;
                        $es->usuario = $user->name;
                        $es->motivo = "Liberação Reservado";
                        $es->save();
                        $prod->estoque += 1;
                        $prod->save();
                    }
                    $cliente = User::find($ped->user_id);
                    $cliente->carrinho -= 1;
                    $cliente->save();
                }
        }
        return back();
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
            if($produtos->status == 'PAGO' || $produtos->status == 'FEITO'){
                $produto = Produto::find($produtos->produto_id);
                if($produto->granel==1){

                } else {
                    $user = Auth::user();
                    $es = new EntradaSaida();
                    $es->tipo = "entrada";
                    $es->produto_id = $produtos->produto_id;
                    $es->quantidade = 1;
                    $es->usuario = $user->name;
                    $es->motivo = "Cancelamento Pedido";
                    $es->save();
                    $produto->estoque += 1;
                    $produto->save();
                }
            }
            $produtos->status = 'CANCEL';
            $produtos->update();
        }
        return back()->with('mensagem-sucesso', 'Pedido cancelado com sucesso!');
    }
}
