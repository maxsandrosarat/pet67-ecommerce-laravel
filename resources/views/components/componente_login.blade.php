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
                          <a href="/compras">Minhas compras</a>
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