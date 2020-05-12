<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', 'IndexController@index')->name('index');
Route::get('/busca', 'IndexController@buscar');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/carrinho', 'CarrinhoController@index');
Route::get('/enderecos', 'EnderecoController@index');
Route::post('/enderecos', 'EnderecoController@store');
Route::get('/enderecos/apagar/{id}', 'EnderecoController@destroy');

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@index')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/cadastros', 'AdminController@cadastros');

    Route::group(['prefix' => 'pedidos'], function() {
        Route::get('/', 'AdminController@pedidos');
        Route::get('/feitos', 'AdminController@pedidos_feitos');
        Route::get('/pagos', 'AdminController@pedidos_pagos');
        Route::get('/cancelados', 'AdminController@pedidos_cancelados');
        Route::get('/pagar/{id}', 'AdminController@pagar_pedido');
        Route::get('/cancelar/{id}', 'AdminController@cancelar_pedido');
    });

    Route::group(['prefix' => 'categorias'], function() {
        Route::get('/', 'CategoriaController@index');
        Route::post('/', 'CategoriaController@store');
        Route::post('/editar/{id}', 'CategoriaController@update');
        Route::get('/apagar/{id}', 'CategoriaController@destroy');
    });

    Route::group(['prefix' => 'tiposAnimais'], function() {
        Route::get('/', 'TipoAnimalController@index');
        Route::post('/', 'TipoAnimalController@store');
        Route::post('/editar/{id}', 'TipoAnimalController@update');
        Route::get('/apagar/{id}', 'TipoAnimalController@destroy');
    });

    Route::group(['prefix' => 'marcas'], function() {
        Route::get('/', 'MarcaController@index');
        Route::post('/', 'MarcaController@store');
        Route::post('/editar/{id}', 'MarcaController@update');
        Route::get('/apagar/{id}', 'MarcaController@destroy');
    });

    Route::group(['prefix' => 'produtos'], function() {
        Route::get('/', 'ProdutoController@index');
        Route::post('/', 'ProdutoController@store');
        Route::post('/editar/{id}', 'ProdutoController@update');
        Route::get('/apagar/{id}', 'ProdutoController@destroy');
        Route::get('/filtro', 'ProdutoController@filtro');
    });

    Route::group(['prefix' => 'cuponsDesconto'], function() {
        Route::get('/', 'CupomDescontoController@index');
        Route::post('/', 'CupomDescontoController@store');
        Route::post('/editar/{id}', 'CupomDescontoController@update');
        Route::get('/apagar/{id}', 'CupomDescontoController@destroy');
    });

    Route::group(['prefix' => 'anuncios'], function() {
        Route::get('/', 'AnuncioController@index');
        Route::post('/', 'AnuncioController@store');
        Route::post('/editar/{id}', 'AnuncioController@update');
        Route::get('/apagar/{id}', 'AnuncioController@destroy');
        Route::post('/{id}', 'AnuncioController@update');
    });

    Route::group(['prefix' => 'estoque'], function() {
        Route::get('/', 'EstoqueController@index');
        Route::get('/filtro', 'EstoqueController@filtro');
        Route::post('/entrada/{id}', 'EstoqueController@entrada');
        Route::post('/saida/{id}', 'EstoqueController@saida');
    });

    Route::group(['prefix' => 'relatorios'], function() {
        Route::get('/', 'RelatorioController@index');
        Route::get('/estoque', 'RelatorioController@estoque');
        Route::get('/estoque/filtro', 'RelatorioController@estoque_filtro');
    });

});

Route::get('/produto/{id}', 'HomeController@produto')->name('produto');
Route::get('/carrinho', 'CarrinhoController@index')->name('carrinho.index');
Route::get('/carrinho/adicionar', function() {
    return redirect()->route('index');
});
Route::post('/carrinho/adicionar', 'CarrinhoController@adicionar')->name('carrinho.adicionar');
Route::delete('/carrinho/remover', 'CarrinhoController@remover')->name('carrinho.remover');
Route::post('/carrinho/concluir', 'CarrinhoController@concluir')->name('carrinho.concluir');
Route::get('/carrinho/compras', 'CarrinhoController@compras')->name('carrinho.compras');
Route::post('/carrinho/cancelar', 'CarrinhoController@cancelar')->name('carrinho.cancelar');
Route::post('/carrinho/desconto', 'CarrinhoController@desconto')->name('carrinho.desconto');

