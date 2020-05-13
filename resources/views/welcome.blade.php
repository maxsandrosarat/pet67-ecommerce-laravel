<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Pet67</title>
        <link rel="shortcut icon" href="/storage/logo/favicon.png"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div>
            @if (Route::has('login'))
                    <div class="icons">
                        <a href="#" class="icon fa-phone" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="bottom" title="Contatos"><span class="label">Telefone</span></a>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Telefone e WhatsApp</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h5 class="icon fa-phone"/> (67) 3385-4316 <a href="tel:6733854316" type="button" class="btn btn-primary">Ligar</a>
                                <h5 class="icon fa-whatsapp"/> (67) 99143-0321 <a href="https://api.whatsapp.com/send?phone=5567991430321&text=Digite%20sua%20mensagem" type="button" class="btn btn-success">Mandar Mensagem</a>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <a href="https://www.facebook.com/Pet067/" target="_blank" class="icon fa-facebook" data-toggle="tooltip" data-placement="bottom" title="Facebook"><span class="label">Facebook</span></a>
                        <a href="https://www.instagram.com/pet67_/" target="_blank" class="icon fa-instagram" data-toggle="tooltip" data-placement="bottom" title="Instagram"><span class="label">Instagram</span></a>
                                                <!-- Button trigger modal -->
                        <a href="#" class="icon fa-envelope-o" data-toggle="modal" data-target="#exampleModa2" data-toggle="tooltip" data-placement="bottom" title="E-mail"><span class="label">Email</span></a>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModa2" tabindex="-1" role="dialog" aria-labelledby="exampleModa2Label" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModa2Label">Email para Elogios, Sugestões e Reclamações</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                sac.pet67@gmail.com <a href="mailto:pet67guaicurus@hotmail.com" type="button" class="btn btn-danger">Mandar um e-mail</a>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Button trigger modal -->
                        <a href="#" class="icon fa-map-marker" data-toggle="modal" data-target="#exampleModa3" data-toggle="tooltip" data-placement="bottom" title="Localização"><span class="label">Localização</span></a>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModa3" tabindex="-1" role="dialog" aria-labelledby="exampleModa2Label" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModa2Label">Endereço</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <a href="https://goo.gl/maps/w4xaUQwcgm9pUbAo8"><iframe style="width: 100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3736.249946422303!2d-54.644058085619484!3d-20.53695176277126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9486e595b0f60b43%3A0x2e91bed800abbd94!2sPet67!5e0!3m2!1spt-BR!2sbr!4v1589060520779!5m2!1spt-BR!2sbr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></a>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    @auth
                        <div class="links">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            SAIR
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        </div>
                      
                        <div class="links">
                          <a href="{{ route('carrinho.index') }}">Carrinho</a>
                        </div>

                        <div class="links">
                          <a href="{{ route('carrinho.compras') }}">Minhas compras</a>
                        </div>

                        <div class="links">
                          <a href="#">Olá, {{Auth::user()->name}}</a>
                        </div>
                    @else
                        <!-- Button trigger modal -->
                        <div class="links">
                          <a href="#" data-toggle="modal" data-target=".bd-example-modal-lgLog">Login</a>
                        </div>
                        
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lgLog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Login <a class="btn btn-link" href="/admin">Login como Admin</a></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="card-body">
                                  <form method="POST" action="{{ route('login') }}">
                                      @csrf
              
                                      <div class="form-group row">
                                          <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>
              
                                          <div class="col-md-6">
                                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              
                                              @error('email')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                      </div>
              
                                      <div class="form-group row">
                                          <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
              
                                          <div class="col-md-6">
                                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
              
                                              @error('password')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                      </div>
              
                                      <div class="form-group row">
                                          <div class="col-md-6 offset-md-4">
                                              <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              
                                                  <label class="form-check-label" for="remember">
                                                      Lembrar Login
                                                  </label>
                                              </div>
                                          </div>
                                      </div>
              
                                      <div class="form-group row mb-0">
                                          <div class="col-md-8 offset-md-4">
                                              <button type="submit" class="btn btn-primary">
                                                  {{ __('Login') }}
                                              </button>
              
                                              @if (Route::has('password.request'))
                                                  <a class="btn btn-link" href="{{ route('password.request') }}">
                                                      Esqueceu sua senha?
                                                  </a>
                                              @endif
                                          </div>
                                      </div>
                                  </form>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Button trigger modal -->
                        <div class="links">
                            <a href="#" data-toggle="modal" data-target=".bd-example-modal-lgCad">Cadastre-se</a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lgCad" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cadastre-se</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>
                
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>
                
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
                
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmação da Senha</label>
                
                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>  
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>
                    @endauth
            @endif
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-dark rounded">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <img src="/storage/logo/pet67_logo3600.png" alt="logo_pet67" width="10%">
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Principal</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">Promoções</a>
                          </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Produtos</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Serviços
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="#">Banho & Tosa</a>
                                  <a class="dropdown-item" href="#">Veterinária</a>
                                  <a class="dropdown-item" href="#">Outros</a>
                                </div>
                              </li>
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Animais
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="#">Codornas</a>
                                  <a class="dropdown-item" href="#">Aves</a>
                                  <a class="dropdown-item" href="#">Outros</a>
                                </div>
                              </li>
                        </ul>
                    </div>
                  </nav>
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
                  <footer class="blockquote-footer" style="text-align: center;">
                    <div class="copyright">
                        &copy; Desenvolvido por Maxsandro Sarat. Todos os direitos reservados.
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
