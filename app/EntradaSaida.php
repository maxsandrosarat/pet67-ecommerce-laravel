<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaSaida extends Model
{
    public function produto(){
        return $this->belongsTo('App\Produto');
    }

    public function tipo_animal(){
        return $this->belongsTo('App\TipoAnimal');
    }

    public function marca(){
        return $this->belongsTo('App\Marca');
    }
}
