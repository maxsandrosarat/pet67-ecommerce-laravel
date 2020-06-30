@extends('layouts.app_admin', ["current"=>"pedidos"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card border-primary mb-4" style="width: 16rem;">
                <div class="card-body text-primary">
                  <h5 class="card-title">Feitos</h5>
                  <p class="card-text">Pedidos feitos!
                      <br/><br/>
                        <a href="/admin/pedidos/feitos" class="btn btn-primary">Feitos</a>
                  </p>
                </div>
            </div>
            <div class="card border-success mb-4" style="width: 16rem;">
                <div class="card-body text-success">
                  <h5 class="card-title">Pagos</h5>
                  <p class="card-text">Pedidos pagos!
                      <br/><br/>
                      <a href="/admin/pedidos/pagos" class="btn btn-success">Pagos</a>
                  </p>
                </div>
            </div>
            <div class="card border-danger mb-4" style="width: 16rem;">
                <div class="card-body text-danger">
                  <h5 class="card-title">Cancelados</h5>
                  <p class="card-text">Pedidos cancelados! 
                      <br/><br/>
                      <a href="/admin/pedidos/cancelados" class="btn btn-danger">Cancelados</a>
                  </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection