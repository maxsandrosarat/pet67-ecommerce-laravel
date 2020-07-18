@extends('layouts.app_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(session('mensagem'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <h5>{{session('mensagem')}}</h5>
                </div>
                @endif
                <div class="card-header">Administrador</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.login.submit') }}">
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
                                <div class="input-group mb-3">
                                    <input id="senha" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" aria-describedby="botao-senha">
                                    <div class="input-group-append">
                                        <button id="botao-senha" class="btn btn-success btn-sm" type="button" data-toggle="tooltip" data-placement="bottom" title="Exibir Senha" onclick="mostrarSenha()"><i id="icone-senha"class="material-icons white">visibility</i></button>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
