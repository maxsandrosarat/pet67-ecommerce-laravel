<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">
        @php
          use App\Image;
          $images = Image::where('nome','logo')->get();
        @endphp
        @foreach ($images as $image)
        <img src="/storage/{{$image->foto}}" alt="logo_pet67" width="100" class="d-inline-block align-top" alt="" loading="lazy">
        @endforeach
    </a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav mr-auto">
            <!--WEB-->
            @auth("web")
            <li @if($current=="home") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/home">Principal</a>
            </li>
            <li @if($current=="compras") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/compras">Minhas Compras</a>
            </li>
            <li @if($current=="carrinho") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="{{ route('carrinho.index') }}">Carrinho</a>
            </li>
            <li @if($current=="enderecos") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/enderecos">Meus Endereços</a>
            </li>
            <li @if($current=="telefones") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/telefones">Meus Telefones</a>
            </li>
            @endauth

            <!--DESLOGADO-->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="/">Principal</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login (Cliente)') }}</a>
            </li>

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastre-se') }}</a>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="/admin">Login (Admin)</a>
            </li>

            <!--LOGADO-->
            @else
            <!--LOGOUT-->
            <li class="nav-item dropdown" class="nav-item">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
  </nav>