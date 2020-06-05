@extends('layouts.app_principal', ["current"=>"animais"])

@section('body')
  @if(count($animais)==0)
  <br/>
  <h5>Sem animais cadastrados!</h5>
  @else
    @foreach ($animais as $animal)
    <div class="card mb-3">
      <div class="card-animal">
        <img src="/storage/{{$animal->foto}}" style="width: 50%" class="card-img-top" alt="{{$animal->nome}}">
      </div>
      <div class="card-animal">
        <div class="card-body">
          <h5 class="card-title">{{$animal->nome}}</h5>
          <p class="card-text">{{$animal->descricao}}</p>
          <p class="card-text"> <small class="text-muted">{{ 'R$ '.number_format($animal->preco, 2, ',', '.')}}</small> </p>
        </div>
      </div>
    </div>
    @endforeach
  @endif
@endsection