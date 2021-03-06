<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'user_id',
        'status'
    ];
 
    public function pedido_produtos()
    {
        return $this->hasMany('App\PedidoProduto')
            ->select( \DB::raw('produto_id, qtdGranel, sum(desconto) as descontos, sum(valor) as valores, count(1) as qtd') )
            ->groupBy('produto_id','qtdGranel')
            ->orderBy('produto_id', 'desc');
    }
 
    public function pedido_produtos_itens()
    {
        return $this->hasMany('App\PedidoProduto');
    }
 
    public static function consultaId($where)
    {
        $pedido = self::where($where)->first(['id']);
        return !empty($pedido->id) ? $pedido->id : null;
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function endereco(){
        return $this->belongsTo('App\Endereco');
    }

    public function entrega(){
        return $this->belongsTo('App\Entrega');
    }

    public function forma_pagamento(){
        return $this->belongsTo('App\FormaPagamento');
    }
}
