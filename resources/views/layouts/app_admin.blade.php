<!doctype html>
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
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body{
            padding: 20px;
        }
        .container{
            margin-top: 20px;
        }
        td{
            text-align: justify;
        }
        #navLogin {
            color:red;
        }                        
    }
    </style>
</head>
<body>
    <div class="container">
        <header>
            @component('components.componente_navbar_admin', ["current"=>$current ?? ''])
            @endcomponent
        </header>
        @auth
            <main>
                @hasSection ('body')
                    @yield('body')   
                @endif
            </main>
        @endauth
        @guest
            <main class="py-4">
                @yield('content')
            </main>
        @endguest
        @component('components.componente_footer')
        @endcomponent
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript">
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

