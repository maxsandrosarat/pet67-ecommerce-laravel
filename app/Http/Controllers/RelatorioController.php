<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EntradaSaida;
use App\Produto;

class RelatorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        return view('relatorios.home_relatorios');
    }

    public function estoque()
    {
        $prods = Produto::where('ativo',true)->orderBy('nome')->get();
        $rels = EntradaSaida::orderBy('created_at','desc')->orderBy('id','desc')->paginate(10);
        $view = "inicial";
        return view('relatorios.entrada_saida_relatorio', compact('view','prods','rels'));
    }

    public function estoque_filtro(Request $request)
    {
        $tipo = $request->input('tipo');
        $codProd = $request->input('produto');
        $dataInicio = $request->input('dataInicio');
        $dataFim = $request->input('dataFim');
        if(isset($tipo)){
            if(isset($codProd)){
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = EntradaSaida::where('tipo','like',"%$tipo%")->where('produto_id',"$codProd")->whereBetween('data',["$dataInicio", "$dataFim"])->paginate(10);;
                    } else {
                        $rels = EntradaSaida::where('tipo','like',"%$tipo%")->where('produto_id',"$codProd")->whereBetween('data',["$dataInicio", date("Y/m/d")])->paginate(10);;
                    }
                } else {
                    $rels = EntradaSaida::where('tipo','like',"%$tipo%")->where('produto_id',"$codProd")->paginate(10);;
                }
            } else {
                $rels = EntradaSaida::where('tipo','like',"%$tipo%")->paginate(10);
            }
        } else {
            if(isset($codProd)){
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = EntradaSaida::where('produto_id',"$codProd")->whereBetween('data',["$dataInicio", "$dataFim"])->paginate(10);;
                    } else {
                        $rels = EntradaSaida::where('produto_id',"$codProd")->whereBetween('data',["$dataInicio", date("Y/m/d")])->paginate(10);;
                    }
                } else {
                    $rels = EntradaSaida::where('produto_id',"$codProd")->paginate(10);
                }
            } else {
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = EntradaSaida::whereBetween('data',["$dataInicio", "$dataFim"])->paginate(10);
                    } else {
                        $rels = EntradaSaida::whereBetween('data',["$dataInicio", date("Y/m/d")])->paginate(10);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = EntradaSaida::whereBetween('data',["", "$dataFim"])->paginate(10);
                    } else {
                        return redirect('/relatorios/estoque');
                    }
                }
            }
        }
        $prods = Produto::where('ativo',true)->orderBy('nome')->get();
        $view = "filtro";
        return view('relatorios.entrada_saida_relatorio', compact('view','prods','rels'));
    }
}
