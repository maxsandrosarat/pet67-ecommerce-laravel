@extends('layouts.app_admin', ["current"=>"cadastros"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary mb-3" style="width: 16rem;">
                <div class="card-body">
                    <h5>Produtos</h5>
                    <p class="card-text">
                        Gerencie seus Produtos!
                    </p>
                    <a href="/admin/produtos" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
            <div class="card border border-primary mb-3" style="width: 16rem;">
                <div class="card-body">
                    <h5>Categorias</h5>
                    <p class="card-text">
                        Gerencie suas Categorias!
                    </p>
                    <a href="/admin/categorias" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
            <div class="card border border-primary mb-3" style="width: 16rem;">
                <div class="card-body">
                    <h5>Marcas</h5>
                    <p class="card-text">
                        Gerencie suas Marcas! 
                    </p>
                    <a href="/admin/marcas" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
            <div class="card border border-primary mb-3" style="width: 16rem;">
                <div class="card-body">
                    <h5>Tipos de Animais</h5>
                    <p class="card-text">
                        Gerencie seus Tipos de Animais! 
                    </p>
                    <a href="/admin/tiposAnimais" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
            <div class="card border border-primary mb-3" style="width: 16rem;">
                <div class="card-body">
                    <h5>Cupons de Desconto</h5>
                    <p class="card-text">
                        Gerencie seus Cupons de Desconto! 
                    </p>
                    <a href="/admin/cuponsDesconto" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
        </div>
    </div>
    <br/><br/>
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary mb-3" style="width: 16rem;">
                <div class="card-body">
                    <h5>Anúncios</h5>
                    <p class="card-text">
                        Gerencie seus Anúncios! 
                    </p>
                    <a href="/admin/anuncios" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
            <div class="card border border-primary mb-3" style="width: 16rem;">
                <div class="card-body">
                    <h5>Animais</h5>
                    <p class="card-text">
                        Gerencie seus Animais!
                    </p>
                    <a href="/admin/animais" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
            <div class="card border border-primary mb-3" style="width: 16rem;">
                <div class="card-body">
                    <h5>Clientes</h5>
                    <p class="card-text">
                        Gerencie seus clientes! 
                    </p>
                    <a href="/admin/clientes" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
            <div class="card border border-primary mb-3" style="width: 16rem;">
                <div class="card-body">
                    <h5>Serviços Estética</h5>
                    <p class="card-text">
                        Gerencie seus Serviços de Estética! 
                    </p>
                    <a href="/admin/servicosEstetica" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
            <div class="card border border-primary mb-3" style="width: 16rem;">
                <div class="card-body">
                    <h5>Serviços Veterinária</h5>
                    <p class="card-text">
                        Gerencie seus Serviços de Veterinária! 
                    </p>
                    <a href="/admin/servicosVeterinaria" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
        </div>
    </div>
    <br/><br/>
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary mb-3" style="width: 16rem;">
                <div class="card-body">
                    <h5>Imagens</h5>
                    <p class="card-text">
                        Gerencie suas Imagens! 
                    </p>
                    <a href="/admin/images" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
            <div class="card border border-primary mb-3" style="width: 16rem;">
                <div class="card-body">
                    <h5>Vacinas</h5>
                    <p class="card-text">
                        Cadastre suas vacinas! 
                    </p>
                    <a href="/admin/vacinas" class="btn btn-primary">Gerenciar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection