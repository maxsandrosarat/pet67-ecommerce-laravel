@extends('layouts.app_principal', ["current"=>"produtos"])

@section('body')
  <div class="row">
    <div id="filtros" class="col">
      <div class="card-deck ">
          <div class="card border border-primary">
              <div class="card-body bg-light mb-3">
                  <h5>Busca</h5>
                  <form class="form-inline my-2 my-lg-0" method="GET" action="/busca">
                      @csrf
                      <label for="categoria">Categoria:</label>
                      <select id="categoria" name="categoria">
                          <option value="">__Selecione__</option>
                          @foreach ($cats as $cat)
                          <option value="{{$cat->id}}">{{$cat->nome}}</option>
                          @endforeach
                      </select>
                      <br/><br/>
                      <label for="tipo">Tipo do Animal:</label>
                      <select id="tipo" name="tipo">
                          <option value="">__Selecione__</option>
                          @foreach ($tipos as $tipo)
                          <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                          @endforeach
                      </select>
                      <br/><br/>
                      <label for="fase">Fase do Animal:</label>
                      <select id="fase" name="fase">
                          <option value="">__Selecione__</option>
                          <option value="filhote">Filhote</option>
                          <option value="adulto">Adulto</option>
                          <option value="castrado">Castrado</option>
                          <option value="todas">Todas</option>
                      </select>
                      <br/><br/>
                      <label for="marca">Marca do Produto:</label>
                      <select id="marca" name="marca">
                          <option value="">__Selecione__</option>
                          @foreach ($marcas as $marca)
                          <option value="{{$marca->id}}">{{$marca->nome}}</option>
                          @endforeach
                      </select>
                      <br/><br/>
                      <input class="form-control mr-sm-2" type="text" size="15" placeholder="Nome do Produto" name="nome" id="nome">
                      <br/><br/>
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                  </form>
              </div>
          </div>
      </div>
    </div>
    <div id="produtos" class="col-8">
      @if(count($prods)==0)
            <br/>
            @if($tipo=="painel")
            <h5>Sem produtos cadastrados!</h5>
            @else
            <h5>Sem resultados para busca!</h5>
            @endif
      @else
        @if($pagina=="promocao")<h2 class="promocao">Promoções</h2>@endif
        <h5>Exibindo {{$prods->count()}} de {{$prods->total()}} de Produtos ({{$prods->firstItem()}} a {{$prods->lastItem()}})</h5>
        <div class="card-columns">
          @foreach ($prods as $prod)
          <div class="card text-white bg-info">
            <button type="button" data-toggle="modal" data-target="#exampleModalFoto{{$prod->id}}">@if($prod->foto!="")<img class="card-img-top" style="margin:0px; padding:0px;" src="/storage/{{$prod->foto}}" alt="foto_produto">@endif</button>
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
                    <img src="/storage/{{$prod->foto}}" alt="foto_perfil" style="width: 100%">
                </div>
                </div>
            </div>
            </div>
            <div class="card-body">
              <p class="card-text">{{$prod->nome}} {{$prod->tipo_animal->nome}} @if($prod->tipo_fase=='filhote') Filhote @else @if($prod->tipo_fase=='adulto') Adulto @else @if($prod->tipo_fase=='castrado') Castrado @endif @endif @endif {{$prod->marca->nome}} @if($prod->embalagem!="Unidade") {{$prod->embalagem}} @endif <br/> <h6>{{ 'R$ '.number_format($prod->preco, 2, ',', '.')}}</h6>
                <form method="POST" action="{{ route('carrinho.adicionar') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $prod->id }}">
                <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="O produto será adicionado ao seu carrinho">Comprar</button>
                @if($prod->promocao==1)<h6 class="promocao">Promoção</h6>@endif
                </form>
              </p>
            </div>
          </div>
          @endforeach
        </div>
        <div class="card-footer">
          {{ $prods->links() }}
        </div>
      @endif
      </div>
    <div id="anuncios" class="col">
        <p>Parceiros</p>
        @foreach ($anuncios as $anuncio)
          <a href="{{$anuncio->link}}" target="_blank"><img class="card-img-top" style="margin:0px; padding:0px;" src="/storage/{{$anuncio->foto}}" alt="{{$anuncio->nome}}"></a>
          <br/><br/>
        @endforeach
    </div>
  </div>
@endsection