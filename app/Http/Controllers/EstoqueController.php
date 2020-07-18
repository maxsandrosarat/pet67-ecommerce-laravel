<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\TipoAnimal;
use App\Marca;
use App\Categoria;
use App\EntradaSaida;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EstoqueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $prods = Produto::paginate(20);
        $tipos = TipoAnimal::all();
        $marcas = Marca::all();
        $cats = Categoria::all();
        return view('estoque.estoque_produtos',compact('prods','tipos','marcas','cats'));
    }

    public function entrada(Request $request, $id)
    {
        $prod = Produto::find($id);
        if(isset($prod)){
            if($request->input('qtd')!=""){
                $user = Auth::user();
                $tipo = "entrada";
                $id = $request->input('produto');
                $qtd = $request->input('qtd');
                $es = new EntradaSaida();
                $es->tipo = $tipo;
                $es->produto_id = $id;
                $es->quantidade = $qtd;
                $es->usuario = $user->name;
                $es->motivo = $request->input('motivo');
                $es->save();
                $prod->estoque += $request->input('qtd');
                $prod->save();
            }
        }
        return back();
    }

    public function saida(Request $request, $id)
    {
        $prod = Produto::find($id);
        if(isset($prod)){
            if($request->input('qtd')!=""){
                $user = Auth::user();
                $tipo = "saida";
                $id = $request->input('produto');
                $qtd = $request->input('qtd');
                $es = new EntradaSaida();
                $es->tipo = $tipo;
                $es->produto_id = $id;
                $es->quantidade = $qtd;
                $es->usuario = $user->name;
                $es->motivo = $request->input('motivo');
                $es->save();
                $prod->estoque -= $request->input('qtd');
                $prod->save();
            }
        }
        return back();
    }

    public function filtro(Request $request)
    {
        $nome = $request->input('nome');
        $cat = $request->input('categoria');
        $tipo = $request->input('tipo');
        $fase = $request->input('fase');
        $marca = $request->input('marca');
        if(isset($nome)){
            if(isset($cat)){
                if(isset($tipo)){
                    if(isset($fase)){
                        if(isset($marca)){
                            $prods = Produto::where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->orderBy('nome')->paginate(10);
                        } else {
                            $prods = Produto::where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->orderBy('nome')->paginate(10); 
                        }
                    } else {
                        $prods = Produto::where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->orderBy('nome')->paginate(10);
                    }
                } else {
                    $prods = Produto::where('nome','like',"%$nome%")->where('categoria_id',"$cat")->orderBy('nome')->paginate(10);
                }
            } else {
                $prods = Produto::where('nome','like',"%$nome%")->orderBy('nome')->paginate(10);
            }
        } else {
            if(isset($cat)){
                if(isset($tipo)){
                    if(isset($fase)){
                        if(isset($marca)){
                            $prods = Produto::where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->orderBy('nome')->paginate(10);
                        } else {
                            $prods = Produto::where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->orderBy('nome')->paginate(10); 
                        }
                    } else {
                        $prods = Produto::where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->orderBy('nome')->paginate(10);
                    }
                } else {
                    $prods = Produto::where('categoria_id',"$cat")->orderBy('nome')->paginate(10);
                }
            } else {
                if(isset($tipo)){
                    if(isset($fase)){
                        if(isset($marca)){
                            $prods = Produto::where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->orderBy('nome')->paginate(10);
                        } else {
                            $prods = Produto::where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->orderBy('nome')->paginate(10); 
                        }
                    } else {
                        $prods = Produto::where('tipo_animal_id',"$tipo")->orderBy('nome')->paginate(10);
                    }
                } else {
                    if(isset($fase)){
                        if(isset($marca)){
                            $prods = Produto::where('tipo_fase',"$fase")->where('marca_id',"$marca")->orderBy('nome')->paginate(10);
                        } else {
                            $prods = Produto::where('tipo_fase',"$fase")->orderBy('nome')->paginate(10); 
                        }
                    } else {
                        if(isset($marca)){
                            $prods = Produto::where('marca_id',"$marca")->orderBy('nome')->paginate(10);
                        } else {
                            return redirect('/admin/estoque');
                        }
                    }
                }
            }
        }
        
        $tipos = TipoAnimal::all();
        $marcas = Marca::all();
        $cats = Categoria::all();
        return view('estoque.estoque_produtos',compact('prods','tipos','marcas','cats'));
    }
}
