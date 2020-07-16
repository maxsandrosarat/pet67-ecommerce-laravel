@extends('layouts.app_admin', ["current"=>"cadastros"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Lista de Serviços de Estética Animal</h5>
            <a type="button" class="float-button" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="bottom" title="Adicionar Novo Serviço">
                <i class="material-icons blue md-60">add_circle</i>
            </a>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Serviço de Estética</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="/admin/servicosEstetica" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nome">Nome do Serviço</label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome do Serviço" required>
                                <label for="preco">Preço do Serviço</label>
                                <input type="text" class="form-control" name="preco" id="preco" placeholder="Exemplo: 10.5" required>
                                <br/>
                                <h5>Descrição do Serviço</h5>
                                <br/>
                                <textarea class="form-control" name="descricao" id="descricao" rows="10" cols="40" maxlength="500" placeholder="Breve resumo do serviço"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
            @if(count($servs)==0)
                <div class="alert alert-danger" role="alert">
                    Sem serviços cadastrados!
                </div>
            @else
            <div class="table-responsive-xl">
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servs as $serv)
                    <tr>
                        <td style="text-align: center;">{{$serv->id}}</td>
                        <td style="text-align: center;">{{$serv->nome}}</td>
                        <td>{{ 'R$ '.number_format($serv->preco, 2, ',', '.')}}</td>
                        <td><button type="button" class="badge badge-primary" data-toggle="modal" data-target="#exampleModalDesc{{$serv->id}}">Descrição</button></td>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalDesc{{$serv->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{$serv->descricao}}
                            </div>
                            </div>
                        </div>
                        </div>
                        <td style="text-align: center;">
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal{{$serv->id}}" data-toggle="tooltip" data-placement="left" title="Editar">
                                <i class="material-icons md-48">edit</i>
                            </button>
                            
                            <div class="modal fade" id="exampleModal{{$serv->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Serviço de Estética</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/admin/servicosEstetica/editar/{{$serv->id}}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nome">Nome do Serviço</label>
                                                <input type="text" class="form-control" name="nome" id="nome" value="{{$serv->nome}}" required>
                                                <label for="preco">Preço do Serviço</label>
                                                <input type="text" class="form-control" name="preco" id="preco" value="{{$serv->preco}}" required>
                                                <br/>
                                                <h5>Descrição do Serviço</h5>
                                                <br/>
                                                <textarea class="form-control" name="descricao" id="descricao" rows="10" cols="40" maxlength="500">{{$serv->descricao}}</textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                                    </div>
                                </form>
                                </div>
                                </div>
                            </div>
                            <a href="/admin/servicosEstetica/apagar/{{$serv->id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Excluir"><i class="material-icons md-48">delete</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
        </div>

    </div>
    <br>
    <a href="/admin/cadastros" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection