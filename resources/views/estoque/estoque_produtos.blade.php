@extends('layouts.app_admin', ["current"=>"estoque"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Controle de Estoque</h5>
            @if(count($prods)==0)
                <br/><br/>
                <div class="alert alert-danger" role="alert">
                    Sem produtos cadastrados!
                </div>
            @else
            <div class="card border">
                <h5>Filtros: </h5>
                <form class="form-inline my-2 my-lg-0" method="GET" action="/admin/estoque/filtro">
                    @csrf
                    <input class="form-control mr-sm-2" type="text" placeholder="Nome do Produto" name="nome">
                    <select id="categoria" name="categoria">
                        <option value="">Selecione uma categoria</option>
                        @foreach ($cats as $cat)
                            <option value="{{$cat->id}}">{{$cat->nome}}</option>
                        @endforeach
                    </select>
                    <select id="tipo" name="tipo">
                        <option value="">Selecione um tipo</option>
                        @foreach ($tipos as $tipo)
                            <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                        @endforeach
                    </select>
                    <select id="fase" name="fase">
                        <option value="">Selecione uma fase</option>
                        <option value="filhote">Filhote</option>
                        <option value="adulto">Adulto</option>
                        <option value="castrado">Castrado</option>
                        <option value="todas">Todas</option>
                    </select>
                    <select id="marca" name="marca">
                        <option value="">Selecione uma marca</option>
                        @foreach ($marcas as $marca)
                            <option value="{{$marca->id}}">{{$marca->nome}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
                </form>
                </div>
                <br/>
            <h5>Exibindo {{$prods->count()}} de {{$prods->total()}} de Produtos ({{$prods->firstItem()}} a {{$prods->lastItem()}})</h5>
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Tipo Animal</th>
                        <th>Tipo Fase</th>
                        <th>Marca</th>
                        <th>Embalagem</th>
                        <th>Estoque</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prods as $prod)
                    <tr>
                        <td width="120"><button type="button" data-toggle="modal" data-target="#exampleModalFoto{{$prod->id}}">@if($prod->foto!="")<img style="margin:0px; padding:0px;" src="/storage/{{$prod->foto}}" alt="foto_produto" width="50%">@endif</button></td>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalFoto{{$prod->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="/storage/{{$prod->foto}}" alt="foto_produto">
                            </div>
                            </div>
                        </div>
                        </div>
                        <td>{{$prod->nome}}</td>
                        <td>{{$prod->tipo_animal->nome}}</td>
                        <td>@if($prod->tipo_fase=='filhote') Filhote @else @if($prod->tipo_fase=='adulto') Adulto @else @if($prod->tipo_fase=='castrado') Castrado @else Todas @endif @endif @endif</td>
                        <td>{{$prod->marca->nome}}</td>
                        <td>{{$prod->embalagem}}</td>
                        <td>{{$prod->estoque}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModalEntrada{{$prod->id}}">
                                Entrada
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalEntrada{{$prod->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Entrada de Produtos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card border">
                                            <div class="card-body">
                                                <form action="/admin/estoque/entrada/{{$prod->id}}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <h6>Produto Selecionado:</h6>
                                                        <h5>{{$prod->nome}} {{$prod->tipo_animal->nome}} @if($prod->tipo_fase=='filhote') Filhote @else @if($prod->tipo_fase=='adulto') Adulto @else @if($prod->tipo_fase=='castrado') Castrado @endif @endif @endif {{$prod->marca->nome}} @if($prod->embalagem!="Unidade") {{$prod->embalagem}} @endif</h5>
                                                        <h6>Quantidade atual:</h6>
                                                        <h5>{{$prod->estoque}}</h5>
                                                        <input type="hidden" name="produto" value="{{$prod->id}}">
                                                        <label for="qtd">Quantidade de Entrada</label>
                                                        <input type="number" id="qtd" name="qtd" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModalSaida{{$prod->id}}">
                                Saída
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalSaida{{$prod->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Saída de Produtos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card border">
                                            <div class="card-body">
                                                <form action="/admin/estoque/saida/{{$prod->id}}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <h6>Produto Selecionado:</h6>
                                                        <h5>{{$prod->nome}} {{$prod->tipo_animal->nome}} @if($prod->tipo_fase=='filhote') Filhote @else @if($prod->tipo_fase=='adulto') Adulto @else @if($prod->tipo_fase=='castrado') Castrado @endif @endif @endif {{$prod->marca->nome}} @if($prod->embalagem!="Unidade") {{$prod->embalagem}} @endif</h5>
                                                        <h6>Quantidade atual:</h6>
                                                        <h5>{{$prod->estoque}}</h5>
                                                        <input type="hidden" name="produto" value="{{$prod->id}}">
                                                        <label for="qtd">Quantidade de Saída</label>
                                                        <input type="number" id="qtd" name="qtd" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <div class="card-footer">
            {{ $prods->links() }}
        </div>
    </div>
    <br>
    <a href="/cadastros" class="btn btn-success">Voltar</a>
@endsection
