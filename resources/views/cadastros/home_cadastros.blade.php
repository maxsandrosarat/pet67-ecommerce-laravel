@extends('layouts.app_admin', ["current"=>"cadastros"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Produtos</h5>
                    <p class="card-text">
                        Cadastre seus produtos!
                    </p>
                    <a href="/admin/produtos" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Categorias</h5>
                    <p class="card-text">
                        Cadastre suas categorias!
                    </p>
                    <a href="/admin/categorias" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Marcas</h5>
                    <p class="card-text">
                        Cadastre suas marcas! 
                    </p>
                    <a href="/admin/marcas" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Tipos de Animais</h5>
                    <p class="card-text">
                        Cadastre seus tipos! 
                    </p>
                    <a href="/admin/tiposAnimais" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Cupons de Desconto</h5>
                    <p class="card-text">
                        Cadastre seus Cupons de Desconto! 
                    </p>
                    <a href="/admin/cuponsDesconto" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
        </div>
    </div>
    <br/><br/>
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Anúncios</h5>
                    <p class="card-text">
                        Cadastre seus anúncios! 
                    </p>
                    <a href="/admin/anuncios" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Serviços</h5>
                    <p class="card-text">
                        Cadastre seus serviços!
                    </p>
                    <a href="/admin/servicos" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Clientes</h5>
                    <p class="card-text">
                        Cadastre seus clientes! 
                    </p>
                    <a href="/admin/clientes" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Pets</h5>
                    <p class="card-text">
                        Cadastre os pets! 
                    </p>
                    <a href="/admin/pets" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5>Vacinas</h5>
                    <p class="card-text">
                        Cadastre suas vacinas! 
                    </p>
                    <a href="/admin/vacinas" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection