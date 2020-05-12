@extends('layouts.app_admin', ["current"=>"relatorios"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Estoque</h5>
                    <p class="card-text">
                        Veja suas entradas e saídas!
                    </p>
                    <a href="/relatorios/estoque" class="btn btn-primary">Verificar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection