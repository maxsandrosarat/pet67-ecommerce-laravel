@extends('layouts.app_admin', ["current"=>"cadastros"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Lista de Produtos</h5>
            <a type="button" class="float-button" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="bottom" title="Adicionar Novo Produto">
                <i class="material-icons blue md-60">add_circle</i>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border">
                            <div class="card-body">
                                <form action="/admin/produtos" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input type="file" id="foto" name="foto" accept=".jpg,.png,jpeg">
                                        <br/>
                                        <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png")</b>
                                        <br/><br/>
                                        <label for="nome">Nome do Produto</label>
                                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Exemplo: Ração" required>
                                        <br/>
                                        <label for="tipo">Tipo de Animal</label>
                                        <select id="tipo" name="tipo" required>
                                            <option value="">Selecione o tipo do animal</option>
                                            @foreach ($tipos as $tipo)
                                                <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                            @endforeach
                                        </select>
                                        <br/><br/>
                                        <label for="fase">Fase do Animal:</label>
                                        <select id="fase" name="fase" required>
                                            <option value="">Selecione a fase do animal</option>
                                            <option value="filhote">Filhote</option>
                                            <option value="adulto">Adulto</option>
                                            <option value="castrado">Castrado</option>
                                            <option value="todas">Todas</option>
                                        </select>
                                        <br/><br/>
                                        <label for="marca">Marca</label>
                                        <select id="marca" name="marca" required>
                                            <option value="">Selecione a marca do produto</option>
                                            @foreach ($marcas as $marca)
                                                <option value="{{$marca->id}}">{{$marca->nome}}</option>
                                            @endforeach
                                        </select>
                                        <br/>
                                        <label for="embalagem">Embalagem do Produto</label>
                                        <input type="text" class="form-control" name="embalagem" id="embalagem" placeholder="Exemplo: 10 KG" required>
                                        <br/>
                                        <label for="preco">Preço do Produto</label>
                                        <input type="text" class="form-control" name="preco" id="preco" placeholder="Exemplo: 10.5" required>
                                        <br/>
                                        <label for="estoque">Estoque do Produto</label>
                                        <input type="number" class="form-control" name="estoque" id="estoque" placeholder="Exemplo: 100" required>
                                        <br/>
                                        <label for="categoria">Categoria</label>
                                        <select id="categoria" name="categoria" required>
                                            <option value="">Selecione</option>
                                            @foreach ($cats as $cat)
                                                <option value="{{$cat->id}}">{{$cat->nome}}</option>
                                            @endforeach
                                        </select>
                                        <h5>Ativo?</h5>
                                        <input type="radio" id="sim" name="ativo" value="sim" required>
                                        <label for="sim">Sim</label>
                                        <input type="radio" id="nao" name="ativo" value="nao" required>
                                        <label for="nao">Não</label>
                                        <h5>Granel?</h5>
                                        <input type="radio" id="sim" name="granel" value="1" required>
                                        <label for="sim">Sim</label>
                                        <input type="radio" id="nao" name="granel" value="0" required>
                                        <label for="nao">Não</label>
                                        <h5>Promoção?</h5>
                                        <input type="radio" id="sim" name="promocao" value="1" required>
                                        <label for="sim">Sim</label>
                                        <input type="radio" id="nao" name="promocao" value="0" required>
                                        <label for="nao">Não</label>
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
            @if(count($prods)==0)
                <div class="alert alert-danger" role="alert">
                    Sem produtos cadastrados!
                </div>
            @else
            <div class="card border">
                <h5>Filtros: </h5>
                <form class="form-inline my-2 my-lg-0" method="GET" action="/admin/produtos/filtro">
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
                        <th>Código</th>
                        <th>Foto</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Categoria</th>
                        <th>Ativo</th>
                        <th>Granel</th>
                        <th>Promoção</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prods as $prod)
                    <tr>
                        <td>{{$prod->id}}</td>
                        <td width="100"><button type="button" data-toggle="modal" data-target="#exampleModalFoto{{$prod->id}}">@if($prod->foto!="")<img style="margin:0px; padding:0px;" src="/storage/{{$prod->foto}}" alt="foto_produto" width="50%">@endif</button></td>
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
                                <img src="/storage/{{$prod->foto}}" alt="foto_produto" style="width: 100%">
                            </div>
                            </div>
                        </div>
                        </div>
                        <td>{{$prod->nome}} {{$prod->tipo_animal->nome}} @if($prod->tipo_fase=='filhote') Filhote @else @if($prod->tipo_fase=='adulto') Adulto @else @if($prod->tipo_fase=='castrado') Castrado @else Todas @endif @endif @endif {{$prod->marca->nome}} {{$prod->embalagem}}</td>
                        <td width="78-">{{ 'R$ '.number_format($prod->preco, 2, ',', '.')}}</td>
                        <td>{{$prod->estoque}}</td>
                        <td>{{$prod->categoria->nome}}</td>
                        <td>@if($prod->ativo=='1') Sim @else Não @endif</td>
                        <td>@if($prod->granel=='1') Sim @else Não @endif</td>
                        <td>@if($prod->promocao=='1') Sim @else Não @endif</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal{{$prod->id}}" data-toggle="tooltip" data-placement="left" title="Editar">
                                <i class="material-icons md-48">edit</i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$prod->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Produto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card border">
                                            <div class="card-body">
                                                <form action="/admin/produtos/editar/{{$prod->id}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="foto">Foto</label>
                                                        <input type="file" id="foto" name="foto" accept=".jpg,.png,jpeg">
                                                        <br/>
                                                        <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png")</b>
                                                        <label for="nome">Nome do Produto</label>
                                                        <input type="text" class="form-control" name="nome" id="nome" value="{{$prod->nome}}" required>
                                                        <br/>
                                                        <label for="tipo">Tipo de Animal</label>
                                                        <select id="tipo" name="tipo" required>
                                                            <option value="{{$prod->tipo_animal->id}}">{{$prod->tipo_animal->nome}}</option>
                                                            @foreach ($tipos as $tipo)
                                                                @if($tipo->id==$prod->tipo_animal->id)
                                                                @else
                                                                <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <br/><br/>
                                                        <label for="fase">Fase do Animal:</label>
                                                        <select id="fase" name="fase">
                                                            <option value="{{$prod->tipo_fase}}">@if($prod->tipo_fase=="filhote") Filhote @else @if($prod->tipo_fase=="adulto") Adulto @else @if($prod->tipo_fase=="castrado") Castrado @else @if($prod->tipo_fase=="todas") Todas @endif @endif @endif @endif</option>
                                                            @if($prod->tipo_fase=="filhote")
                                                            <option value="adulto">Adulto</option>
                                                            <option value="castrado">Castrado</option>
                                                            <option value="todas">Todas</option>
                                                            @else
                                                                @if($prod->tipo_fase=="adulto")
                                                                <option value="filhote">Filhote</option>
                                                                <option value="castrado">Castrado</option>
                                                                <option value="todas">Todas</option>
                                                                @else
                                                                    @if($prod->tipo_fase=="castrado")
                                                                    <option value="filhote">Filhote</option>
                                                                    <option value="adulto">Adulto</option>
                                                                    <option value="todas">Todas</option>
                                                                    @else
                                                                        @if($prod->tipo_fase=="todas")
                                                                        <option value="filhote">Filhote</option>
                                                                        <option value="adulto">Adulto</option>
                                                                        <option value="castrado">Castrado</option>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </select>
                                                        <br/><br/>
                                                        <label for="marca">Marca</label>
                                                        <select id="marca" name="marca" required>
                                                            <option value="{{$prod->marca->id}}">{{$prod->marca->nome}}</option>
                                                            @foreach ($marcas as $marca)
                                                                @if($marca->id==$prod->marca->id)
                                                                @else
                                                                <option value="{{$marca->id}}">{{$marca->nome}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <br/><br/>
                                                        <label for="embalagem">Embalagem do Produto</label>
                                                        <input type="text" class="form-control" name="embalagem" id="embalagem" value="{{$prod->embalagem}}" required>
                                                        <br/>
                                                        <label for="preco">Preço do Produto</label>
                                                        <input type="text" class="form-control" name="preco" id="preco" value="{{$prod->preco}}" required>
                                                        <br/>
                                                        <label for="estoque">Estoque do Produto</label>
                                                        <input type="number" class="form-control" name="estoque" id="estoque" value="{{$prod->estoque}}" required>
                                                        <br><br/>
                                                        <label for="categoria">Categoria</label>
                                                        <select id="categoria" name="categoria" required>
                                                            <option value="{{$prod->categoria->id}}">{{$prod->categoria->nome}}</option>
                                                            @foreach ($cats as $cat)
                                                                @if($cat->id==$prod->categoria->id)
                                                                @else
                                                                <option value="{{$cat->id}}">{{$cat->nome}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <h5>Ativo?</h5>
                                                        <input type="radio" id="sim" name="ativo" value="1" @if($prod->ativo=="1") checked @endif required>
                                                        <label for="sim">Sim</label>
                                                        <input type="radio" id="nao" name="ativo" value="0" @if($prod->ativo=="0") checked @endif required>
                                                        <label for="nao">Não</label>
                                                        <h5>Granel?</h5>
                                                        <input type="radio" id="sim" name="granel" value="1" @if($prod->granel=="1") checked @endif required>
                                                        <label for="sim">Sim</label>
                                                        <input type="radio" id="nao" name="granel" value="0" @if($prod->granel=="0") checked @endif required>
                                                        <label for="nao">Não</label>
                                                        <h5>Promoção?</h5>
                                                        <input type="radio" id="sim" name="promocao" value="1" @if($prod->promocao=="1") checked @endif required>
                                                        <label for="sim">Sim</label>
                                                        <input type="radio" id="nao" name="promocao" value="0" @if($prod->promocao=="0") checked @endif required>
                                                        <label for="nao">Não</label>
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
                            <a href="/admin/produtos/apagar/{{$prod->id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Excluir"><i class="material-icons md-48">delete</i></a>
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
    <a href="/admin/cadastros" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection
