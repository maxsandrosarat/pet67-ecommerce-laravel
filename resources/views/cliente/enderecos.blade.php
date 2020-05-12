@extends('layouts.app_cliente', ["current"=>"enderecos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Lista de Endereços</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Cadastre suas Endereços
            </button>
            <br/><br/>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Endereço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <h6><b>Caso saiba seu CEP, digite e em seguida os campos serão autocompletados</b></h6>
                        <form method="post" action="/enderecos">
                            @csrf
                                <label>Cep:
                                <input name="cep" type="text" id="cep" value="" size="10" maxlength="9"
                                       onblur="pesquisacep(this.value);" /></label><br />
                                <label>Rua:
                                <input name="rua" type="text" id="rua" size="60" /></label><br />
                                <label>Bairro:
                                <input name="bairro" type="text" id="bairro" size="40" /></label><br />
                                <label>Cidade:
                                <input name="cidade" type="text" id="cidade" size="40" /></label><br />
                                <label>Estado:
                                <input name="uf" type="text" id="uf" size="2" /></label><br />
                                <input name="ibge" type="hidden" id="ibge" size="8" />
                                <label for="numero">Número</label>
                                <input type="number" name="numero" id="numero" size="5"><br>
                                <label for="complemento">Complemento</label>
                                <input type="text" name="complemento" id="complemento" size="60">
                                <label for="tipo">Tipo</label>
                                <select name="tipo" id="tipo" required>
                                    <option value="RESIDENCIAL">Residencial</option>
                                    <option value="COMERCIAL">Comercial</option>
                                </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
            @if(count($enderecos)==0)
                <br/><br/>
                <div class="alert alert-danger" role="alert">
                    Sem endereços cadastrados!
                </div>
            @else
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Rua</th>
                        <th>Número</th>
                        <th>Complemento</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>UF</th>
                        <th>Tipo</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enderecos as $endereco)
                    <tr>
                        <td>{{$endereco->rua}}</td>
                        <td>{{$endereco->numero}}</td>
                        <td>{{$endereco->complemento}}</td>
                        <td>{{$endereco->bairro}}</td>
                        <td>{{$endereco->cidade}}</td>
                        <td>{{$endereco->uf}}</td>
                        <td>{{$endereco->tipo}}</td>
                        <td>
                            <a href="/enderecos/apagar/{{$endereco->id}}" class="btn btn-sm btn-danger">Apagar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

    </div>
    <br>
    <a href="/" class="btn btn-success">Voltar</a>
@endsection