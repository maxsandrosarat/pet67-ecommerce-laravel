@extends('layouts.app_admin', ["current"=>"pedidos"])

@section('body')

<div class="container">
    <div scope="row">
        @if (Session::has('mensagem-sucesso'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ Session::get('mensagem-sucesso') }}</strong>
            </div>
        @endif
        @if (Session::has('mensagem-falha'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ Session::get('mensagem-falha') }}</strong>
            </div>
        @endif
        <hr/>
        <div>
            <h4 style="color: red;">Compras Canceladas</h4>
            <hr/>
            @forelse ($cancelados as $pedido)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Cliente</th>
                            <th>Criação</th>
                            <th>Cancelamento</th>
                            <th>Produtos</th>
                            <th>Valor</th>
                            <th>Desconto</th>
                            <th>Total</th>
                         </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->user->name }}</td>
                            <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $pedido->updated_at->format('d/m/Y H:i') }}</td>
                        @php
                            $total_produto = 0;
                            $total_valor = 0;
                            $total_desconto = 0;
                            $total_pedido = 0;
                        @endphp
                        <td>
                            <ul>
                        @foreach ($pedido->pedido_produtos_itens as $pedido_produto)
                            @php
                            if($pedido_produto->status == 'CANCEL'){
                                $total_produto += $pedido_produto->valor - $pedido_produto->desconto;
                                $total_valor += $pedido_produto->valor;
                                $total_desconto += $pedido_produto->desconto;
                                $total_pedido += $total_produto;
                            }
                            @endphp
                            @if($pedido_produto->status == 'CANCEL')
                                <li>{{ $pedido_produto->produto->nome }} {{$pedido_produto->produto->tipo_animal->nome}} @if($pedido_produto->produto->tipo_fase=='filhote') Filhote @else @if($pedido_produto->produto->tipo_fase=='adulto') Adulto @else @if($pedido_produto->produto->tipo_fase=='castrado') Castrado @endif @endif @endif {{$pedido_produto->produto->marca->nome}} @if($pedido_produto->produto->embalagem!="Unidade") {{$pedido_produto->produto->embalagem}} @endif</li>
                            @endif
                        @endforeach
                            </ul>
                        </td>
                                <td>R$ {{ number_format($total_valor, 2, ',', '.') }}</td>
                                <td>R$ {{ number_format($total_desconto, 2, ',', '.') }}</td>
                                <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                </table>
            @empty
                <h5 class="center">Nenhuma compra foi cancelada.</h5>
            @endforelse
        </div>
        <hr/>
    </div>
    <div class="card-footer">
        {{ $cancelados->links() }}
    </div>
</div>
@endsection