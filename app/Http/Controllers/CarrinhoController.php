<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pedido;
use App\Produto;
use App\PedidoProduto;
use App\CupomDesconto;
use App\Endereco;

class CarrinhoController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::user()->id;
        $pedidos = Pedido::where('status','RESERV')->where('user_id',"$id")->get();
        $enderecos = Endereco::where('user_id',"$id")->get();
        return view('cliente.carrinho', compact('pedidos','enderecos'));
    }

    public function adicionar(Request $request)
    {

        $this->middleware('VerifyCsrfToken');
        $idproduto = $request->input('id');
        $produto = Produto::find($idproduto);
        if( empty($produto->id) ) {
            $request->session()->flash('mensagem-falha', 'Produto não encontrado em nossa loja!');
            return redirect()->route('carrinho.index');
        }

        $idUser = Auth::user()->id;

        $idpedido = Pedido::consultaId([
            'user_id' => $idUser,
            'status'  => 'RESERV' // Reservada
            ]);

        if( empty($idpedido) ) {
            $pedido = new Pedido();
            $pedido->user_id = $idUser;
            $pedido->status = 'RESERV';
            $pedido->save();

            $idpedido = $pedido->id;

        }

        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->pedido_id = $idpedido;
        $pedidoProduto->produto_id = $idproduto;
        $pedidoProduto->valor = $produto->preco;
        $pedidoProduto->status = 'RESERV';
        $pedidoProduto->save();

        $request->session()->flash('mensagem-sucesso', 'Produto adicionado ao carrinho com sucesso!');

        return redirect()->route('carrinho.index');

    }

    public function remover(Request $request)
    {

        $this->middleware('VerifyCsrfToken');

        $idpedido           = $request->input('pedido_id');
        $idproduto          = $request->input('produto_id');
        $remove_apenas_item = (boolean)$request->input('item');
        $idusuario          = Auth::user()->id;

        $idpedido = Pedido::consultaId([
            'id'      => $idpedido,
            'user_id' => $idusuario,
            'status'  => 'RESERV' // Reservada
            ]);

        if( empty($idpedido) ) {
            $request->session()->flash('mensagem-falha', 'Pedido não encontrado!');
            return redirect()->route('carrinho.index');
        }

        $where_produto = [
            'pedido_id'  => $idpedido,
            'produto_id' => $idproduto
        ];

        $produto = PedidoProduto::where($where_produto)->orderBy('id', 'desc')->first();
        if( empty($produto->id) ) {
            $request->session()->flash('mensagem-falha', 'Produto não encontrado no carrinho!');
            return redirect()->route('carrinho.index');
        }

        if( $remove_apenas_item ) {
            $where_produto['id'] = $produto->id;
        }
        PedidoProduto::where($where_produto)->delete();

        $check_pedido = PedidoProduto::where([
            'pedido_id' => $produto->pedido_id
            ])->exists();

        if( !$check_pedido ) {
            Pedido::where([
                'id' => $produto->pedido_id
                ])->delete();
        }

        $request->session()->flash('mensagem-sucesso', 'Produto removido do carrinho com sucesso!');

        return redirect()->route('carrinho.index');
    }

    public function concluir(Request $request)
    {
        $this->middleware('VerifyCsrfToken');

        $idpedido  = $request->input('pedido_id');
        $idendereco  = $request->input('endereco');
        $idusuario = Auth::user()->id;

        $pedido = Pedido::find($idpedido);
        $pedido->endereco_id = $idendereco;
        $pedido->update();

        $check_pedido = Pedido::where([
            'id'      => $idpedido,
            'user_id' => $idusuario,
            'status'  => 'RESERV' // Reservada
            ])->exists();

        if( !$check_pedido ) {
            $request->session()->flash('mensagem-falha', 'Pedido não encontrado!');
            return redirect()->route('carrinho.index');
        }

        $check_produtos = PedidoProduto::where([
            'pedido_id' => $idpedido
            ])->exists();
        if(!$check_produtos) {
            $request->session()->flash('mensagem-falha', 'Produtos do pedido não encontrados!');
            return redirect()->route('carrinho.index');
        }

        PedidoProduto::where([
            'pedido_id' => $idpedido
            ])->update([
                'status' => 'FEITO'
            ]);
        Pedido::where([
                'id' => $idpedido
            ])->update([
                'status' => 'FEITO'
            ]);

        $request->session()->flash('mensagem-sucesso', 'Pedido concluído com sucesso!');
        $enderecos = Endereco::all();
        return redirect()->route('carrinho.compras', compact('enderecos'));
    }

    public function compras()
    {

        $compras = Pedido::where([
            'status'  => 'FEITO',
            'user_id' => Auth::user()->id
            ])->orderBy('created_at', 'desc')->get();

        $cancelados = Pedido::where([
            'status'  => 'CANCEL',
            'user_id' => Auth::user()->id
            ])->orderBy('updated_at', 'desc')->get();
        $enderecos = Endereco::all();
        return view('cliente.compras', compact('compras', 'cancelados','enderecos'));

    }

    public function cancelar(Request $request)
    {
        $this->middleware('VerifyCsrfToken');

        $idpedido       = $request->input('pedido_id');
        $idspedido_prod = $request->input('id');
        $idusuario      = Auth::user()->id;

        if( empty($idspedido_prod) ) {
            $request->session()->flash('mensagem-falha', 'Nenhum item selecionado para cancelamento!');
            return redirect()->route('carrinho.compras');
        }

        $check_pedido = Pedido::where([
            'id'      => $idpedido,
            'user_id' => $idusuario,
            'status'  => 'FEITO' // Pago
            ])->exists();

        if( !$check_pedido ) {
            $request->session()->flash('mensagem-falha', 'Pedido não encontrado para cancelamento!');
            return redirect()->route('carrinho.compras');
        }

        $check_produtos = PedidoProduto::where([
                'pedido_id' => $idpedido,
                'status'    => 'FEITO'
            ])->whereIn('id', $idspedido_prod)->exists();

        if( !$check_produtos ) {
            $request->session()->flash('mensagem-falha', 'Produtos do pedido não encontrados!');
            return redirect()->route('carrinho.compras');
        }

        PedidoProduto::where([
                'pedido_id' => $idpedido,
                'status'    => 'FEITO'
            ])->whereIn('id', $idspedido_prod)->update([
                'status' => 'CANCEL'
            ]);

        $check_pedido_cancel = PedidoProduto::where([
                'pedido_id' => $idpedido,
                'status'    => 'FEITO'
            ])->exists();

        if( !$check_pedido_cancel ) {
            Pedido::where([
                'id' => $idpedido
            ])->update([
                'status' => 'CANCEL'
            ]);

            $request->session()->flash('mensagem-sucesso', 'Compra cancelada com sucesso!');

        } else {
            $request->session()->flash('mensagem-sucesso', 'Item(ns) da compra cancelado(s) com sucesso!');
        }

        return redirect()->route('carrinho.compras');
    }

    public function desconto()
    {
        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idpedido  = $req->input('pedido_id');
        $cupom     = $req->input('cupom');
        $idusuario = Auth::id();

        if( empty($cupom) ) {
            $req->session()->flash('mensagem-falha', 'Cupom inválido!');
            return redirect()->route('carrinho.index');
        }

        $cupom = CupomDesconto::where([
            'localizador' => $cupom,
            'ativo'       => '1'
            ])->where('validade', '>', date('Y-m-d'))->first();

        if( empty($cupom->id) ) {
            $req->session()->flash('mensagem-falha', 'Cupom de desconto não encontrado!');
            return redirect()->route('carrinho.index');
        }

        $check_pedido = Pedido::where([
            'id'      => $idpedido,
            'user_id' => $idusuario,
            'status'  => 'RESERV' // Reservado
            ])->exists();

        if( !$check_pedido ) {
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado para validação!');
            return redirect()->route('carrinho.index');
        }

        $pedido_produtos = PedidoProduto::where([
                'pedido_id' => $idpedido,
                'status'    => 'RESERV'
            ])->get();

        if( empty($pedido_produtos) ) {
            $req->session()->flash('mensagem-falha', 'Produtos do pedido não encontrados!');
            return redirect()->route('carrinho.index');
        }

        $aplicou_desconto = false;
        foreach ($pedido_produtos as $pedido_produto) {

            switch ($cupom->modo_desconto) {
                case 'porc':
                    $valor_desconto = ( $pedido_produto->valor * $cupom->desconto ) / 100;
                    break;

                default:
                    $valor_desconto = $cupom->desconto;
                    break;
            }

            $valor_desconto = ($valor_desconto > $pedido_produto->valor) ? $pedido_produto->valor : number_format($valor_desconto, 2);

            switch ($cupom->modo_limite) {
                case 'qtd':
                    $qtd_pedido = PedidoProduto::whereIn('status', ['FEITO', 'RESERV'])->where([
                            'cupom_desconto_id' => $cupom->id
                        ])->count();

                    if( $qtd_pedido >= $cupom->limite ) {
                        
                    }
                    break;

                default:
                    $valor_ckc_descontos = PedidoProduto::whereIn('status', ['FEITO', 'RESERV'])->where([
                            'cupom_desconto_id' => $cupom->id
                        ])->sum('desconto');

                    if( ($valor_ckc_descontos+$valor_desconto) > $cupom->limite ) {
                        
                    }
                    break;
            }

            $pedido_produto->cupom_desconto_id = $cupom->id;
            $pedido_produto->desconto          = $valor_desconto;
            $pedido_produto->update();

            $aplicou_desconto = true;

        }

        if( $aplicou_desconto ) {
            $req->session()->flash('mensagem-sucesso', 'Cupom aplicado com sucesso!');
        } else {
            $req->session()->flash('mensagem-falha', 'Cupom esgotado!');
        }
        return redirect()->route('carrinho.index');

    }
}
