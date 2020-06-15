@extends('layouts.app_principal', ["current"=>"servicos"])

@section('body')
  <div class="card border">
    <div class="card-body">
      <h5 class="card-title">Lista de Serviços de Médica Veterinária</h5>
      <div>
        @php
        use App\Image;
        $images = Image::where('nome','veterinaria')->get();
        @endphp
        @foreach ($images as $image)
        <img src="/storage/{{$image->foto}}" class="img-fluid" alt="veterinaria" width="50%">
        @endforeach
      </div>
        @if(count($servs)==0)
          <div class="alert alert-danger" role="alert">
            Sem serviços cadastrados!
          </div>
        @else
          <br/>
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Serviço</th>
                        <th>Preço</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servs as $serv)
                    <tr>
                        <td>{{$serv->nome}}</td>
                        <td>{{ 'R$ '.number_format($serv->preco, 2, ',', '.')}}</td>
                        <td>{{$serv->descricao}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          @endif
    </div>
  </div>
@endsection