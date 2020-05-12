<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public function tipo_animal(){
        return $this->belongsTo('App\TipoAnimal');
    }

    public function marca(){
        return $this->belongsTo('App\Marca');
    }

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
