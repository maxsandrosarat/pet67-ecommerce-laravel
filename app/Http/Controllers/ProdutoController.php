<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\TipoAnimal;
use App\Marca;
use App\Categoria;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $prods = Produto::paginate(20);
        $tipos = TipoAnimal::where('ativo',true)->orderBy('nome')->get();
        $marcas = Marca::where('ativo',true)->orderBy('nome')->get();
        $cats = Categoria::where('ativo',true)->orderBy('nome')->get();
        return view('cadastros.produtos',compact('prods','tipos','marcas','cats'));
    }

    public function store(Request $request)
    {
        $prod = new Produto();
        if($request->file('foto')!=""){
            $path = $request->file('foto')->store('fotos_produtos','public');
            $prod->foto = $path;
        }
        if($request->input('nome')!=""){
            $prod->nome = $request->input('nome');
        }
        if($request->input('tipo')!=""){
        $prod->tipo_animal_id = $request->input('tipo');
        }
        if($request->input('fase')!=""){
        $prod->tipo_fase = $request->input('fase');
        }
        if($request->input('marca')!=""){
        $prod->marca_id = $request->input('marca');
        }
        if($request->input('embalagem')!=""){
        $prod->embalagem = $request->input('embalagem');
        }
        if($request->input('preco')!=""){
        $prod->preco = $request->input('preco');
        }
        if($request->input('estoque')!=""){
        $prod->estoque = $request->input('estoque');
        }
        if($request->input('categoria')!=""){
            $prod->categoria_id = $request->input('categoria');
        }
        if($request->input('ativo')!=""){
            $prod->ativo = $request->input('ativo');
        }
        if($request->input('promocao')!=""){
            $prod->promocao = $request->input('promocao');
        }
        if($request->input('granel')!=""){
            $prod->granel = $request->input('granel');
        }
        $prod->save();
        return back();
    }

    public function update(Request $request, $id)
    {
        $prod = Produto::find($id);
        if(isset($prod)){
            if($request->file('foto')!=""){
                Storage::disk('public')->delete($prod->foto);
                $path = $request->file('foto')->store('fotos_produtos','public');
                $prod->foto = $path;
            }
            if($request->input('nome')!=""){
                $prod->nome = $request->input('nome');
            }
            if($request->input('tipo')!=""){
            $prod->tipo_animal_id = $request->input('tipo');
            }
            if($request->input('fase')!=""){
            $prod->tipo_fase = $request->input('fase');
            }
            if($request->input('marca')!=""){
            $prod->marca_id = $request->input('marca');
            }
            if($request->input('embalagem')!=""){
            $prod->embalagem = $request->input('embalagem');
            }
            if($request->input('preco')!=""){
            $prod->preco = $request->input('preco');
            }
            if($request->input('estoque')!=""){
            $prod->estoque = $request->input('estoque');
            }
            if($request->input('categoria')!=""){
                $prod->categoria_id = $request->input('categoria');
            }
            if($request->input('ativo')!=""){
                $prod->ativo = $request->input('ativo');
            }
            if($request->input('promocao')!=""){
                $prod->promocao = $request->input('promocao');
            }
            if($request->input('granel')!=""){
                $prod->granel = $request->input('granel');
            }
            $prod->save();
        }
        return back();
    }

    public function destroy($id)
    {
        $prod = Produto::find($id);
        if(isset($prod)){
            $prod->ativo = false;
            $prod->save();
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
                            return redirect('/admin/produtos');
                        }
                    }
                }
            }
        }
        
        $tipos = TipoAnimal::where('ativo',true)->orderBy('nome')->get();
        $marcas = Marca::where('ativo',true)->orderBy('nome')->get();
        $cats = Categoria::where('ativo',true)->orderBy('nome')->get();
        return view('cadastros.produtos',compact('prods','tipos','marcas','cats'));
    }
}
