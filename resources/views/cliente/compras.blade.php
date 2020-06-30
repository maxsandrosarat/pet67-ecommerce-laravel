@extends('layouts.app_cliente', ["current"=>"compras"])

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
            <h4 style="color: green;">Compras Concluídas</h4>
            @forelse ($compras as $pedido)
            <hr/>
                <div>
                    <h5 scope="col"> Nº do Pedido: {{ $pedido->id }}  - Status: {{$pedido->status}}</h5>
                    <h5 scope="col"> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>
                </div>
                <div class="table-responsive-xl">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="1"></th>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Desconto</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $total_pedido = 0;
                        @endphp
                        @foreach ($pedido->pedido_produtos_itens as $pedido_produto)
                            @php
                                $total_produto = $pedido_produto->valor - $pedido_produto->desconto;
                                if($pedido_produto->status == 'FEITO'){
                                    $total_pedido += $total_produto;
                                }''
                            @endphp
                            <tr>
                                <td>
                                    <img width="100" height="100" src="/storage/{{ $pedido_produto->produto->foto }}">
                                </td>
                                <td>{{ $pedido_produto->produto->nome }} {{$pedido_produto->produto->tipo_animal->nome}} @if($pedido_produto->produto->tipo_fase=='filhote') Filhote @else @if($pedido_produto->produto->tipo_fase=='adulto') Adulto @else @if($pedido_produto->produto->tipo_fase=='castrado') Castrado @endif @endif @endif {{$pedido_produto->produto->marca->nome}} @if($pedido_produto->produto->embalagem!="Unidade") {{$pedido_produto->produto->embalagem}} @endif
                                    <br/>
                                    @if($pedido_produto->status == 'CANCEL')
                                    <strong style="color: red;" class="red-text">CANCELADO</strong>
                                    @endif
                                </td>
                                <td>R$ {{ number_format($pedido_produto->produto->preco, 2, ',', '.') }}</td>
                                @if($pedido_produto->produto->granel=="1")
                                <td>{{number_format($pedido_produto->qtdGranel, 1, ',', '.')}} KG</td>
                                @else
                                <td>1</td>
                                @endif
                                <td>R$ {{ number_format($pedido_produto->desconto, 2, ',', '.') }}</td>
                                @if($pedido_produto->status == 'CANCEL')
                                <td width="80">R$ {{ number_format(0, 2, ',', '.') }}</td>
                                @else
                                <td width="80">R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    @if($pedido->status=="FEITO")
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$pedido->id}}">
                                    Cancelar Item
                                    </button>
                                    @endif
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$pedido->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cancelamento de Item</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('carrinho.cancelar') }}">
                                                @csrf
                                                <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2"></th>
                                                            <th>Produto</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($pedido->pedido_produtos_itens as $pedido_produto)
                                                        @php
                                                            $total_produto = $pedido_produto->valor - $pedido_produto->desconto;
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                @if($pedido_produto->status == 'FEITO')
                                                                    <p>
                                                                        <input type="checkbox" id="item-{{ $pedido_produto->id }}" name="id[]" value="{{ $pedido_produto->id }}" />
                                                                        <label for="item-{{ $pedido_produto->id }}">Selecionar    </label>
                                                                    </p>
                                                                @else
                                                                    @if($pedido_produto->status == 'PAGO')
                                                                    <strong style="color: green;" class="red-text">PAGO</strong>
                                                                    @else
                                                                    <strong style="color: red;" class="red-text">CANCELADO</strong>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <img width="100" height="100" src="/storage/{{ $pedido_produto->produto->foto }}">
                                                            </td>
                                                            <td>{{ $pedido_produto->produto->nome }} {{$pedido_produto->produto->tipo_animal->nome}} @if($pedido_produto->produto->tipo_fase=='filhote') Filhote @else @if($pedido_produto->produto->tipo_fase=='adulto') Adulto @else @if($pedido_produto->produto->tipo_fase=='castrado') Castrado @endif @endif @endif {{$pedido_produto->produto->marca->nome}} @if($pedido_produto->produto->embalagem!="Unidade") {{$pedido_produto->produto->embalagem}} @endif</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger" data-position="bottom" data-delay="50" data-tooltip="Cancelar itens selecionados">
                                                Cancelar
                                            </button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </td>
                                <td colspan="2"></td>
                                <td width="200"><strong>Total do Pedido:</strong></td>
                                <td width="100">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="1">Entrega:</td>
                                <td colspan="5"><b>{{$pedido->endereco->rua}}, {{$pedido->endereco->numero}}@if($pedido->endereco->complemento!="") ({{$pedido->endereco->complemento}}) @else @endif- {{$pedido->endereco->bairro}} - {{$pedido->endereco->cidade}} - {{$pedido->endereco->uf}}</b>
                                    @if($pedido->observacao!="")
                                    <br/>
                                    Observação: {{$pedido->observacao}}
                                    @endif
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
            @empty
                <h5 class="center">
                    Você ainda não fez nenhuma compra válida.
                </h5>
            @endforelse
        </div>
        <hr/>
    </div>
</div>
<h5>Ajude-nos a manter contato, cadastre seus telefones 
    <a type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Cadastrar Novo Telefone" href="/telefones">Cadastrar Telefone</a>
</h5>
@endsection