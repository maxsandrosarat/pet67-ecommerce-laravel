<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EntradaSaida;
use App\Pedido;
use App\PedidoProduto;
use App\Produto;
use App\User;
use Illuminate\Support\Facades\DB;

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
        if($request->input('dataInicio')!=""){
            $dataInicio = $request->input('dataInicio').' '."00:00:00";
        }
        if($request->input('dataFim')!=""){
            $dataFim = $request->input('dataFim').' '."23:59:00";
        }
        if(isset($tipo)){
            if(isset($codProd)){
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = EntradaSaida::where('tipo','like',"%$tipo%")->where('produto_id',"$codProd")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = EntradaSaida::where('tipo','like',"%$tipo%")->where('produto_id',"$codProd")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = EntradaSaida::where('tipo','like',"%$tipo%")->where('produto_id',"$codProd")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = EntradaSaida::where('tipo','like',"%$tipo%")->where('produto_id',"$codProd")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                }
            } else {
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = EntradaSaida::where('tipo','like',"%$tipo%")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = EntradaSaida::where('tipo','like',"%$tipo%")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = EntradaSaida::where('tipo','like',"%$tipo%")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = EntradaSaida::where('tipo','like',"%$tipo%")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                }
            }
        } else {
            if(isset($codProd)){
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = EntradaSaida::where('produto_id',"$codProd")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = EntradaSaida::where('produto_id',"$codProd")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = EntradaSaida::where('produto_id',"$codProd")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = EntradaSaida::where('produto_id',"$codProd")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                }
            } else {
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = EntradaSaida::whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = EntradaSaida::where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = EntradaSaida::where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = EntradaSaida::orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                }
            }
        }
        $prods = Produto::where('ativo',true)->orderBy('nome')->get();
        $view = "filtro";
        return view('relatorios.entrada_saida_relatorio', compact('view','prods','rels'));
    }

    public function indexVendas()
    {
        return view('relatorios.home_relatorios_vendas');
    }

    public function vendasProdutos()
    {
        $prods = Produto::where('ativo',true)->orderBy('nome')->get();
        $rels = PedidoProduto::orderBy('created_at','desc')->orderBy('id','desc')->paginate(10);
        $view = "inicial";
        return view('relatorios.vendas_produtos_relatorio', compact('view','prods','rels'));
    }

    public function vendasProdutosFiltro(Request $request)
    {
        $status = $request->input('status');
        $codProd = $request->input('produto');
        if($request->input('dataInicio')!=""){
            $dataInicio = $request->input('dataInicio').' '."00:00:00";
        }
        if($request->input('dataFim')!=""){
            $dataFim = $request->input('dataFim').' '."23:59:00";
        }
        if(isset($status)){
            if(isset($codProd)){
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = PedidoProduto::where('status','like',"%$status%")->where('produto_id',"$codProd")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = PedidoProduto::where('status','like',"%$status%")->where('produto_id',"$codProd")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = PedidoProduto::where('status','like',"%$status%")->where('produto_id',"$codProd")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = PedidoProduto::where('status','like',"%$status%")->where('produto_id',"$codProd")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                }
            } else {
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = PedidoProduto::where('status','like',"%$status%")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = PedidoProduto::where('status','like',"%$status%")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = PedidoProduto::where('status','like',"%$status%")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = PedidoProduto::where('status','like',"%$status%")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                }
            }
        } else {
            if(isset($codProd)){
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = PedidoProduto::where('produto_id',"$codProd")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = PedidoProduto::where('produto_id',"$codProd")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = PedidoProduto::where('produto_id',"$codProd")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = PedidoProduto::where('produto_id',"$codProd")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                }
            } else {
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = PedidoProduto::whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = PedidoProduto::where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = PedidoProduto::where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = PedidoProduto::orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                }
            }
        }
        $total_valor = $rels->sum('valor');
        $total_desconto = $rels->sum('desconto');
        $total_geral = $total_valor - $total_desconto;
        $prods = Produto::where('ativo',true)->orderBy('nome')->get();
        $view = "filtro";
        return view('relatorios.vendas_produtos_relatorio', compact('view','prods','rels','total_valor','total_desconto','total_geral'));
    }

    public function vendasClientes()
    {
        $clientes = User::orderBy('name')->get();
        $rels = Pedido::orderBy('created_at','desc')->paginate(10);
        $view = "inicial";
        return view('relatorios.vendas_clientes_relatorio', compact('view','clientes','rels'));
    }

    public function vendasClientesFiltro(Request $request)
    {
        $status = $request->input('status');
        $codCliente = $request->input('cliente');
        if($request->input('dataInicio')!=""){
            $dataInicio = $request->input('dataInicio').' '."00:00:00";
        }
        if($request->input('dataFim')!=""){
            $dataFim = $request->input('dataFim').' '."23:59:00";
        }
        if(isset($status)){
            if(isset($codCliente)){
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = Pedido::where('status','like',"%$status%")->where('user_id',"$codCliente")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = Pedido::where('status','like',"%$status%")->where('user_id',"$codCliente")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = Pedido::where('status','like',"%$status%")->where('user_id',"$codCliente")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = Pedido::where('status','like',"%$status%")->where('user_id',"$codCliente")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                }
            } else {
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = Pedido::where('status','like',"%$status%")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = Pedido::where('status','like',"%$status%")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = Pedido::where('status','like',"%$status%")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = Pedido::where('status','like',"%$status%")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                }
            }
        } else {
            if(isset($codCliente)){
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = Pedido::where('user_id',"$codCliente")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = Pedido::where('user_id',"$codCliente")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = Pedido::where('user_id',"$codCliente")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = Pedido::where('user_id',"$codCliente")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                }
            } else {
                if(isset($dataInicio)){
                    if(isset($dataFim)){
                        $rels = Pedido::whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = Pedido::where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                } else {
                    if(isset($dataFim)){
                        $rels = Pedido::where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    } else {
                        $rels = Pedido::orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                    }
                }
            }
        }
        $total_valor = $rels->sum('total');
        $clientes = User::orderBy('name')->get();
        $view = "filtro";
        return view('relatorios.vendas_clientes_relatorio', compact('view','clientes','rels','total_valor'));
    }

    public function vendasClientesProdutos()
    {
        $clientes = User::orderBy('name')->get();
        $prods = Produto::where('ativo',true)->orderBy('nome')->get();
        $rels = Pedido::orderBy('created_at','desc')->paginate(10);
        $view = "inicial";
        return view('relatorios.clientes_produtos', compact('view','clientes','prods','rels'));
    }

    public function vendasClientesProdutosFiltro(Request $request)
    {
        $status = $request->input('status');
        $codCliente = $request->input('cliente');
        $codProd = $request->input('produto');
        if($request->input('dataInicio')!=""){
            $dataInicio = $request->input('dataInicio').' '."00:00:00";
        }
        if($request->input('dataFim')!=""){
            $dataFim = $request->input('dataFim').' '."23:59:00";
        }
        if(isset($status)){
            if(isset($codCliente)){
                if(isset($codProd)){
                    if(isset($dataInicio)){
                        if(isset($dataFim)){
                            $rels = Pedido::where('status','like',"%$status%")->where('user_id',"$codCliente")->where('produto_id',"$codProd")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('status','like',"%$status%")->where('user_id',"$codCliente")->where('produto_id',"$codProd")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    } else {
                        if(isset($dataFim)){
                            $rels = Pedido::where('status','like',"%$status%")->where('user_id',"$codCliente")->where('produto_id',"$codProd")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('status','like',"%$status%")->where('user_id',"$codCliente")->where('produto_id',"$codProd")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    }
                } else {
                    if(isset($dataInicio)){
                        if(isset($dataFim)){
                            $rels = Pedido::where('status','like',"%$status%")->where('user_id',"$codCliente")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('status','like',"%$status%")->where('user_id',"$codCliente")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    } else {
                        if(isset($dataFim)){
                            $rels = Pedido::where('status','like',"%$status%")->where('user_id',"$codCliente")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('status','like',"%$status%")->where('user_id',"$codCliente")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    }
                }
            } else {
                if(isset($codProd)){
                    if(isset($dataInicio)){
                        if(isset($dataFim)){
                            $rels = Pedido::where('status','like',"%$status%")->where('produto_id',"$codProd")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('status','like',"%$status%")->where('produto_id',"$codProd")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    } else {
                        if(isset($dataFim)){
                            $rels = Pedido::where('status','like',"%$status%")->where('produto_id',"$codProd")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('status','like',"%$status%")->where('produto_id',"$codProd")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    }
                } else {
                    if(isset($dataInicio)){
                        if(isset($dataFim)){
                            $rels = Pedido::where('status','like',"%$status%")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('status','like',"%$status%")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    } else {
                        if(isset($dataFim)){
                            $rels = Pedido::where('status','like',"%$status%")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('status','like',"%$status%")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    }
                }
            }
        } else {
            if(isset($codCliente)){
                if(isset($codProd)){
                    if(isset($dataInicio)){
                        if(isset($dataFim)){
                            $rels = Pedido::where('user_id',"$codCliente")->where('produto_id',"$codProd")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('user_id',"$codCliente")->where('produto_id',"$codProd")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    } else {
                        if(isset($dataFim)){
                            $rels = Pedido::where('user_id',"$codCliente")->where('produto_id',"$codProd")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('user_id',"$codCliente")->where('produto_id',"$codProd")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    }
                } else {
                    if(isset($dataInicio)){
                        if(isset($dataFim)){
                            $rels = Pedido::where('user_id',"$codCliente")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('user_id',"$codCliente")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    } else {
                        if(isset($dataFim)){
                            $rels = Pedido::where('user_id',"$codCliente")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('user_id',"$codCliente")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    }
                }
            } else {
                if(isset($codProd)){
                    if(isset($dataInicio)){
                        if(isset($dataFim)){
                            $rels = Pedido::where('produto_id',"$codProd")->whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('produto_id',"$codProd")->where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    } else {
                        if(isset($dataFim)){
                            $rels = Pedido::where('produto_id',"$codProd")->where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('produto_id',"$codProd")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    }
                } else {
                    if(isset($dataInicio)){
                        if(isset($dataFim)){
                            $rels = Pedido::whereBetween('created_at',["$dataInicio", "$dataFim"])->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::where('created_at','>=',"$dataInicio")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    } else {
                        if(isset($dataFim)){
                            $rels = Pedido::where('created_at','<=',"$dataFim")->orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        } else {
                            $rels = Pedido::orderBy('created_at','desc')->orderBy('id','desc')->paginate(100);
                        }
                    }
                }
            }
        }
        $clientes = User::orderBy('name')->get();
        $prods = Produto::where('ativo',true)->orderBy('nome')->get();
        $view = "filtro";
        return view('relatorios.clientes_produtos', compact('view','clientes','prods','rels'));
    }

}
