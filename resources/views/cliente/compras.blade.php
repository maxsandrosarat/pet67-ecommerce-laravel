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
                    <h5 scope="col"> Pedido: {{ $pedido->id }} </h5>
                    <h5 scope="col"> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>
                </div>
                <form method="POST" action="{{ route('carrinho.cancelar') }}">
                    @csrf
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="2"></th>
                                <th>Produto</th>
                                <th>Valor</th>
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
                                    @if($pedido_produto->status == 'FEITO')
                                        <p>
                                            <input type="checkbox" id="item-{{ $pedido_produto->id }}" name="id[]" value="{{ $pedido_produto->id }}" />
                                            <label for="item-{{ $pedido_produto->id }}">Cancelar    </label>
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
                                <td>R$ {{ number_format($pedido_produto->valor, 2, ',', '.') }}</td>
                                <td>R$ {{ number_format($pedido_produto->desconto, 2, ',', '.') }}</td>
                                <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td><strong>Total do pedido</strong></td>
                                <td>R$ {{ number_format($total_pedido, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Endereço de Entrega:</td>
                                @foreach($enderecos as $endereco)
                                    @if($endereco->id == $pedido->endereco_id)
                                    <td colspan="4"><b>{{$endereco->rua}}, {{$endereco->numero}} ({{$endereco->complemento}}) - {{$endereco->bairro}} - {{$endereco->cidade}} - {{$endereco->uf}}</b></td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-danger" data-position="bottom" data-delay="50" data-tooltip="Cancelar itens selecionados">
                                        Cancelar
                                    </button>   
                                </td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            @empty
                <h5 class="center">
                    @if ($cancelados->count() > 0)
                        Neste momento não há nenhuma compra valida.
                    @else
                        Você ainda não fez nenhuma compra.
                    @endif
                </h5>
            @endforelse
        </div>
        <hr/>
        <div>
            <h4 style="color: red;">Compras Canceladas</h4>
            @forelse ($cancelados as $pedido)
            <hr/>
                <h5 scope="col"> Pedido: {{ $pedido->id }} </h5>
                <h5 scope="col"> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>
                <h5 scope="col"> Cancelado em: {{ $pedido->updated_at->format('d/m/Y H:i') }} </h5>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Produto</th>
                            <th>Valor</th>
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
                                $total_pedido += $total_produto;
                            @endphp
                        <tr>
                            <td>
                                <img width="100" height="100" src="/storage/{{ $pedido_produto->produto->foto }}">
                            </td>
                            <td>{{ $pedido_produto->produto->nome }}</td>
                            <td>R$ {{ number_format($pedido_produto->valor, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($pedido_produto->desconto, 2, ',', '.') }}</td>
                            
                            <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td><strong>Total do pedido</strong></td>
                            <td>R$ {{ number_format($total_pedido, 2, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            @empty
                <h5 class="center">Nenhuma compra ainda foi cancelada.</h5>
            @endforelse
        </div>
        <hr/>
    </div>

</div>

@endsection