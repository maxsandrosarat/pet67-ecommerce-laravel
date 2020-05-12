@extends('layouts.app_admin', ["current"=>"relatorios"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Relatório de Entradas/Saídas</h5>
            @if(count($rels)==0)
                <br/><br/>
                <div class="alert alert-danger" role="alert">
                    Sem movimentações!
                </div>
            @else
            <div class="card border">
            <h5>Filtros: </h5>
            <form class="form-inline my-2 my-lg-0" method="GET" action="/relatorios/estoque/filtro">
                @csrf
                <label for="tipo">Tipo</label>
                <select id="tipo" name="tipo">
                    <option value="">Selecione o tipo</option>
                    <option value="entrada">Entrada</option>
                    <option value="saida">Saída</option>
                </select>
                <label for="produto">Produto</label>
                <input class="form-control mr-sm-2" type="number" placeholder="Código do Produto" name="produto">
                <label for="dataInicio">Data Início</label>
                <input class="form-control mr-sm-2" type="date" name="dataInicio">
                <label for="dataFim">Data Fim</label>
                <input class="form-control mr-sm-2" type="date" name="dataFim">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
            </form>
            </div>
            <br/>
            <table id="yesprint" class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código Movimento</th>
                        <th>Tipo Movimento</th>
                        <th>Código Produto</th>
                        <th>Nome Produto</th>
                        <th>Quantidade</th>
                        <th>Usuário</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rels as $rel)
                    @if($rel->tipo=='entrada') <tr style="color:blue;"> @else <tr style="color:green; font-weight: bold;"> @endif
                        <td>{{$rel->id}}</td>
                        <td>@if($rel->tipo=='entrada') Entrada @else Saída @endif</td>
                        <td>{{$rel->produto->id}}</td>
                        <td>{{$rel->produto->nome}} {{$rel->produto->tipo_animal->nome}} @if($rel->produto->tipo_fase=='filhote') Filhote @else @if($rel->produto->tipo_fase=='adulto') Adulto @else @if($rel->produto->tipo_fase=='castrado') Castrado @endif @endif @endif {{$rel->produto->marca->nome}} @if($rel->produto->embalagem!="Unidade") {{$rel->produto->embalagem}} @endif</td>
                        <td>{{$rel->quantidade}}</td>
                        <td>{{$rel->usuario}}</td>
                        <td>{{date("d/m/Y", strtotime($rel->data))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <div class="card-footer">
            {{ $rels->links() }}
        </div>
    </div>
    <br/>
    <a href="/estoque" class="btn btn-success">Voltar</a>
@endsection