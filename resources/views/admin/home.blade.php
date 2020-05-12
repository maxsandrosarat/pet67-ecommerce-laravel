@extends('layouts.app_admin', ["current"=>"home"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Pedidos</h5>
                    <p class="card-text">
                        Cadastre seus pedidos e outros!
                    </p>
                    <a href="/admin/pedidos" class="btn btn-primary">Pedidos</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Cadastros</h5>
                    <p class="card-text">
                        Cadastre seus produtos e outros!
                    </p>
                    <a href="/admin/cadastros" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Estoque</h5>
                    <p class="card-text">
                        Controle seu estoque!
                    </p>
                    <a href="/admin/estoque" class="btn btn-primary">Estoque</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Relatórios</h5>
                    <p class="card-text">
                        Veja seus relatórios e desempenho! 
                    </p>
                    <a href="/admin/relatorios" class="btn btn-primary">Relatórios</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection