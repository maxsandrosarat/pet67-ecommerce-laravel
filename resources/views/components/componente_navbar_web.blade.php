<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
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
          <li @if($current=="home") class="nav-item active" @else class="nav-item" @endif>
              <a class="nav-link" href="/">Principal</a>
          </li>
          <li @if($current=="produtos") class="nav-item active" @else class="nav-item" @endif>
              <a class="nav-link" href="/produtos">Todos os Produtos</a>
          </li>
          <li @if($current=="animais") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="/animais">Animais</a>
          </li>
          <li @if($current=="servicos") class="nav-item dropdown active" @else class="nav-item dropdown" @endif>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Serviços
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="/servicosEstetica">Banho & Tosa</a>
                <a class="dropdown-item" href="/servicosVeterinaria">Veterinária</a>
              </div>
            </li>
      </ul>
  </div>
</nav>