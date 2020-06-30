<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Pet67</title>
        @php
            use App\Image;
            $images = Image::where('nome','favicon')->get();
        @endphp
        @foreach ($images as $image)
        <link rel="shortcut icon" href="/storage/{{$image->foto}}"/>
        @endforeach
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
                @component('components.componente_login')
                @endcomponent
                @component('components.componente_icons')
                @endcomponent
            @endif
            <div class="container">
              @component('components.componente_navbar_web', ["current"=>$current ?? ''])
              @endcomponent 
                <main>
                  @hasSection ('body')
                      @yield('body')   
                  @endif
                </main>
                @component('components.componente_footer')
                @endcomponent 
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function id(campo){
                return document.getElementById(campo);
            }

            function formataNumeroTelefone() {
                var numero = document.getElementById('telefone').value;
                var length = numero.length;
                var telefoneFormatado;
                
                if (length == 10) {
                telefoneFormatado = '(' + numero.substring(0, 2) + ') ' + numero.substring(2, 6) + '-' + numero.substring(6, 10);
                } else if (length == 11) {
                telefoneFormatado = '(' + numero.substring(0, 2) + ') ' + numero.substring(2, 7) + '-' + numero.substring(7, 11);
                } else {
                    telefoneFormatado = 'Número Inválido, digite número com DDD';
                }
                id('telefone').value = telefoneFormatado;
            }

            function id(campo){
                return document.getElementById(campo);
            }

            function mostrarSenha(){
                var tipo = document.getElementById("senha");
                if(tipo.type=="password"){
                    tipo.type = "text";
                    id('icone-senha').innerHTML = "visibility_off";
                    id('botao-senha').className = "btn btn-warning btn-sm";
                    id('botao-senha').title = "Ocultar Senha";
                } else {
                    tipo.type = "password";
                    id('icone-senha').innerHTML = "visibility";
                    id('botao-senha').className = "btn btn-success btn-sm";
                    id('botao-senha').title = "Mostrar Senha";
                }
            }
            
        </script>
    </body>
</html>
