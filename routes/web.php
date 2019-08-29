<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/perfil', 'UserController@profile')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(array('prefix' => 'dashboard'), function()
{
    Route::get('/maisConsumidos', 'DashboardController@maisConsumidos');
});

Route::group(array('prefix' => 'categorias'), function()
{
    Route::get('', 'CategoriasController@index');
    Route::get('/add', 'CategoriasController@add');
    Route::post('', 'CategoriasController@addPost');
    Route::get('/{id}/delete', 'CategoriasController@delete');
    Route::get('/{id}/edit', 'CategoriasController@edit');
    Route::post('/edit', 'CategoriasController@editPost');
    Route::get('/{id}/change-status', 'CategoriasController@changeStatus');
    Route::get('/{id}/view', 'CategoriasController@view');
    Route::get('/filter', 'CategoriasController@filter');
});

Route::group(array('prefix' => 'produto'), function()
{
    Route::get('', 'ProdutoController@index');
    Route::get('/add', 'ProdutoController@add');
    Route::post('', 'ProdutoController@addPost');
    Route::get('/{id}/delete', 'ProdutoController@delete');
    Route::get('/{id}/edit', 'ProdutoController@edit');
    Route::post('/edit', 'ProdutoController@editPost');
    Route::get('/{id}/change-status', 'ProdutoController@changeStatus');
    Route::get('/{id}/view', 'ProdutoController@view');
    Route::get('/nome','ProdutoController@pesquisarNomeproduto');
    Route::get('/filter', 'ProdutoController@filter');
});

Route::group(array('prefix' => 'user'), function()
{
    Route::get('', 'UserController@index')->middleware('isadmin');
    Route::get('/add', 'UserController@add')->middleware('isadmin');
    Route::post('', 'UserController@addPost')->middleware('isadmin');
    Route::get('/{id}/delete', 'UserController@delete')->middleware('isadmin');
    Route::get('/{id}/edit', 'UserController@edit')->middleware('isadmin');
    Route::post('/edit', 'UserController@editPost');
    Route::get('/{id}/change-status', 'UserController@changeStatus');
    Route::get('/{id}/view', 'UserController@view')->middleware('isadmin');
    Route::get('/filter', 'UserController@filter')->middleware('isadmin');
});

Route::group(array('prefix' => 'ordem-servico'), function()
{
    Route::get('', 'OrdemServicoController@index');
    Route::get('/add', 'OrdemServicoController@add');
    Route::post('', 'OrdemServicoController@addPost');
    Route::get('/{id}/delete', 'OrdemServicoController@delete');
    Route::get('/{id}/edit', 'OrdemServicoController@edit');
    Route::post('/edit', 'OrdemServicoController@editPost');
    Route::get('/{id}/change-status', 'OrdemServicoController@changeStatus');
    Route::get('/{id}/view', 'OrdemServicoController@view');
    Route::get('/filter', 'OrdemServicoController@filter');
    Route::get('{id}/pdf', 'OrdemServicoController@pdf');
    Route::get('{id}/email', 'OrdemServicoController@sendMailWithPDFAttached');

});

Route::group(array('prefix' => 'cliente'), function()
{
    Route::get('', 'ClienteController@index');
    Route::get('/add', 'ClienteController@add');
    Route::post('', 'ClienteController@addPost');
    Route::get('/{id}/delete', 'ClienteController@delete');
    Route::get('/{id}/edit', 'ClienteController@edit');
    Route::post('/edit', 'ClienteController@editPost');
    Route::get('/{id}/change-status', 'ClienteController@changeStatus');
    Route::get('/{id}/view', 'ClienteController@view');
    Route::get('/filter', 'ClienteController@filter');
});

