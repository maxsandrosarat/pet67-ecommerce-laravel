@extends('layouts.app_principal', ["current"=>"animais"])

@section('body')
  @if(count($animais)==0)
  <br/>
  <h5>Sem animais cadastrados!</h5>
  @else
  <div class="row row-cols-1 row-cols-md-2">
    @foreach ($animais as $animal)
    <div class="col mb-4">
      <div class="card">
        <img src="/storage/{{$animal->foto}}" class="card-img-top" alt="{{$animal->nome}}">
        <div class="card-body">
          <h3 class="card-title">{{$animal->nome}}</h3>
          <p class="card-text">{{$animal->descricao}}</p>
          <p class="card-text"> <small class="text-muted">{{ 'R$ '.number_format($animal->preco, 2, ',', '.')}}</small> </p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif
@endsection