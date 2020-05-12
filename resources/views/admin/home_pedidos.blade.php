@extends('layouts.app_admin', ["current"=>"pedidos"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card text-white bg-primary mb-3" style="width: 18rem;">
                <div class="card-header">Feitos</div>
                    <div class="card-body">
                        <p class="card-text">
                            Pedidos feitos!
                        </p>
                        <a href="/admin/pedidos/feitos" class="btn btn-info">Feitos</a>
                    </div>
                </div>
            </div>
            <div class="card text-white bg-success mb-3" style="width: 18rem;">
                <div class="card-header">Pagos</div>
                    <div class="card-body">
                        <p class="card-text">
                            Pedidos pagos!
                        </p>
                        <a href="/admin/pedidos/pagos" class="btn btn-info">Pagos</a>
                    </div>
                </div>
            </div>
            <div class="card text-white bg-danger mb-3" style="width: 18rem;">
                <div class="card-header">Cancelados</div>
                    <div class="card-body">
                        <p class="card-text">
                            Pedidos cancelados! 
                        </p>
                        <a href="/admin/pedidos/cancelados" class="btn btn-info">Cancelados</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection