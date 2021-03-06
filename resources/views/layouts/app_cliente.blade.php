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
    <div class="container-xl">
        <header>
            @component('components.componente_navbar_cliente', ["current"=>$current ?? ''])
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
        $(document).ready(function(){
            $('#troco').children('div').hide();
            $('#selectTipoPagamento').on('change', function(){
                
                var selectValorGeral = '#'+$(this).val();
                $('#troco').children('div').hide();
                $('#troco').children(selectValorGeral).show();

            });

        });

        function validarSenhaForca(){
            var senha = document.getElementById('senhaForca').value;
            var forca = 0;
            /*Imprimir a senha*/
            /*document.getElementById("impSenha").innerHTML = "Senha " + senha;*/
        
            if((senha.length >= 4) && (senha.length <= 8)){
                forca += 10;
            }else if(senha.length > 8){
                forca += 25;
            }
        
            if((senha.length >= 5) && (senha.match(/[a-z]+/))){
                forca += 10;
            }
        
            if((senha.length >= 6) && (senha.match(/[A-Z]+/))){
                forca += 20;
            }
        
            if((senha.length >= 7) && (senha.match(/[@#$%&;*]/))){
                forca += 25;
            }
        
            if(senha.match(/([1-9]+)\1{1,}/)){
                forca += -25;
            }
        
            mostrarForca(forca);
        }
        
        function mostrarForca(forca){
            /*Imprimir a força da senha*/
            /*document.getElementById("impForcaSenha").innerHTML = "Força: " + forca;*/
        
            if(forca < 30 ){
                document.getElementById("erroSenhaForca").innerHTML = '<div class="progress"><div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
            }else if((forca >= 30) && (forca < 50)){
                document.getElementById("erroSenhaForca").innerHTML = '<div class="progress"><div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div>';
            }else if((forca >= 50) && (forca < 70)){
                document.getElementById("erroSenhaForca").innerHTML = '<div class="progress"><div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div></div>';
            }else if((forca >= 70) && (forca < 100)){
                document.getElementById("erroSenhaForca").innerHTML = '<div class="progress"><div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
            }
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

        function id(campo){
            return document.getElementById(campo);
        }

        
        function getValor(campo){
            var valor = document.getElementById(campo).value.replace(',','.');
            return parseFloat(valor);
        }


        function granel( idproduto ){
            var qtd = getValor('qtd');
            var total = qtd * getValor('preco');
            var valor = total;
	        var valorFormatado = valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            id('total').value = valorFormatado;
            

            $('#form-adicionar-produto-granel input[name="id"]').val(idproduto);
            $('#form-adicionar-produto-granel  input[name="qtd"]').val(qtd);
            $('#form-adicionar-produto-granel  input[name="total"]').val(total);
            $('#form-adicionar-produto-granel').submit();
        }

        function formataNumeroTelefone() {
            var numero = document.getElementById('numero').value;
            var length = numero.length;
            var telefoneFormatado;
            
            if (length == 10) {
            telefoneFormatado = '(' + numero.substring(0, 2) + ') ' + numero.substring(2, 6) + '-' + numero.substring(6, 10);
            } else if (length == 11) {
            telefoneFormatado = '(' + numero.substring(0, 2) + ') ' + numero.substring(2, 7) + '-' + numero.substring(7, 11);
            } else {
                telefoneFormatado = 'Número Inválido, digite número com DDD';
            }
            id('numero').value = telefoneFormatado;
        }



        function carrinhoRemoverProduto( idpedido, idproduto, item ) {
            $('#form-remover-produto input[name="pedido_id"]').val(idpedido);
            $('#form-remover-produto input[name="produto_id"]').val(idproduto);
            $('#form-remover-produto input[name="item"]').val(item);
            $('#form-remover-produto').submit();
        }
        
        function carrinhoAdicionarProduto( idproduto ) {
            $('#form-adicionar-produto input[name="id"]').val(idproduto);
            $('#form-adicionar-produto').submit();
        }
    
        function limpa_formulário_cep() {
                //Limpa valores do formulário de cep.
                document.getElementById('rua').value=("");
                document.getElementById('bairro').value=("");
                document.getElementById('cidade').value=("");
                document.getElementById('uf').value=("");
                document.getElementById('ibge').value=("");
        }
    
        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('rua').value=(conteudo.logradouro);
                document.getElementById('bairro').value=(conteudo.bairro);
                document.getElementById('cidade').value=(conteudo.localidade);
                document.getElementById('uf').value=(conteudo.uf);
                document.getElementById('ibge').value=(conteudo.ibge);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }
            
        function pesquisacep(valor) {
    
            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');
    
            //Verifica se campo cep possui valor informado.
            if (cep != "") {
    
                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;
    
                //Valida o formato do CEP.
                if(validacep.test(cep)) {
    
                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('rua').value="...";
                    document.getElementById('bairro').value="...";
                    document.getElementById('cidade').value="...";
                    document.getElementById('uf').value="...";
                    document.getElementById('ibge').value="...";
    
                    //Cria um elemento javascript.
                    var script = document.createElement('script');
    
                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
    
                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);
    
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
    
        </script>
</body>
</html>

