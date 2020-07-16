<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Anuncio;
use Illuminate\Http\Request;
use App\Produto;
use App\Categoria;
use App\Marca;
use App\ServicoEstetica;
use App\ServicoVeterinaria;
use App\TipoAnimal;

class IndexController extends Controller
{
    public function index()
    {
        $tipo = "painel";
        $pagina = "promocao";
        $prods = Produto::where('ativo',true)->where('promocao',true)->paginate(12);
        $tipos = TipoAnimal::orderBy('nome')->get();
        $marcas = Marca::orderBy('nome')->get();
        $cats = Categoria::orderBy('nome')->get();
        $anuncios = Anuncio::where('ativo',true)->get();
        return view('welcome',compact('tipo','pagina','prods','tipos','marcas','cats','anuncios'));
    }

    public function produtos()
    {
        $tipo = "painel";
        $pagina = "produto";
        $prods = Produto::where('ativo',true)->paginate(12);
        $tipos = TipoAnimal::orderBy('nome')->get();
        $marcas = Marca::orderBy('nome')->get();
        $cats = Categoria::orderBy('nome')->get();
        $anuncios = Anuncio::where('ativo',true)->get();
        return view('produtos',compact('tipo','pagina','prods','tipos','marcas','cats','anuncios'));
    }

    public function buscar(Request $request)
    {
        $nome = $request->input('nome');
        $cat = $request->input('categoria');
        $tipo = $request->input('tipo');
        $fase = $request->input('fase');
        $marca = $request->input('marca');
        $granel = $request->input('granel');
        if(isset($nome)){
            if(isset($cat)){
                if(isset($tipo)){
                    if(isset($fase)){
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->orderBy('nome')->paginate(12);
                            } 
                        }
                    } else {
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->orderBy('nome')->paginate(12);
                            } 
                        }
                    }
                } else {
                    if(isset($fase)){
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_fase',"$fase")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('tipo_fase',"$fase")->orderBy('nome')->paginate(12);
                            } 
                        }
                    } else {
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->orderBy('nome')->paginate(12);
                            }
                        }
                    }
                }
            } else {
                if(isset($tipo)){
                    if(isset($fase)){
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->orderBy('nome')->paginate(12);
                            } 
                        }
                    } else {
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('tipo_animal_id',"$tipo")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('tipo_animal_id',"$tipo")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('tipo_animal_id',"$tipo")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('tipo_animal_id',"$tipo")->orderBy('nome')->paginate(12);
                            } 
                        }
                    }
                } else {
                    if(isset($fase)){
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('tipo_fase',"$fase")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('tipo_fase',"$fase")->orderBy('nome')->paginate(12);
                            } 
                        }
                    } else {
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('nome','like',"%$nome%")->orderBy('nome')->paginate(12);
                            }
                        }
                    }
                }
            }
        } else {
            if(isset($cat)){
                if(isset($tipo)){
                    if(isset($fase)){
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->orderBy('nome')->paginate(12);
                            }
                        }
                    } else {
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('tipo_animal_id',"$tipo")->orderBy('nome')->paginate(12);
                            }
                        }
                    }
                } else {
                    if(isset($fase)){
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('tipo_fase',"$fase")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('tipo_fase',"$fase")->orderBy('nome')->paginate(12);
                            }
                        }
                    } else {
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('categoria_id',"$cat")->orderBy('nome')->paginate(12);
                            }
                        }
                    }
                }
            } else {
                if(isset($tipo)){
                    if(isset($fase)){
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('tipo_animal_id',"$tipo")->where('tipo_fase',"$fase")->orderBy('nome')->paginate(12); 
                            }
                        }
                    } else {
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('tipo_animal_id',"$tipo")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('tipo_animal_id',"$tipo")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('tipo_animal_id',"$tipo")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('tipo_animal_id',"$tipo")->orderBy('nome')->paginate(12); 
                            }
                        }
                    }
                } else {
                    if(isset($fase)){
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('tipo_fase',"$fase")->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('tipo_fase',"$fase")->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('tipo_fase',"$fase")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('tipo_fase',"$fase")->orderBy('nome')->paginate(12); 
                            }
                        }
                    } else {
                        if(isset($marca)){
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('marca_id',"$marca")->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->where('marca_id',"$marca")->orderBy('nome')->paginate(12);
                            }
                        } else {
                            if(isset($granel)){
                                $prods = Produto::where('ativo',true)->where('granel',"$granel")->orderBy('nome')->paginate(12);
                            } else {
                                $prods = Produto::where('ativo',true)->orderBy('nome')->paginate(12); 
                            }
                        }
                    }
                }
            }
        }
        $tipo = "filtro";
        $pagina = "produto";
        $anuncios = Anuncio::where('ativo',true)->get();
        $tipos = TipoAnimal::all();
        $marcas = Marca::all();
        $cats = Categoria::all();
        return view('produtos',compact('tipo','pagina','prods','tipos','marcas','cats','anuncios'));
    }

    public function animais()
    {
        $animais = Animal::where('ativo',true)->get();
        return view('animais',compact('animais'));
    }

    public function servicosEstetica()
    {
        $servs = ServicoEstetica::all();
        return view('servicos_estetica',compact('servs'));
    }

    public function servicosVeterinaria()
    {
        $servs = ServicoVeterinaria::all();
        return view('servicos_veterinaria',compact('servs'));
    }
}
