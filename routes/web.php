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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/perfil', 'UserController@profile')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(array('prefix' => 'dashboard'), function()
{
    Route::get('/maisConsumidos', 'DashboardController@maisConsumidos');

});

Route::group(array('prefix' => 'Categorias'), function()
{
    Route::get('/', 'CategoriasController@index');
    Route::get('/add-Categorias', 'CategoriasController@add');
    Route::post('/add-Categorias-post', 'CategoriasController@addPost');
    Route::get('/delete-Categorias/{id}', 'CategoriasController@delete');
    Route::get('/edit-Categorias/{id}', 'CategoriasController@edit');
    Route::post('/edit-Categorias-post', 'CategoriasController@editPost');
    Route::get('/change-status-Categorias/{id}', 'CategoriasController@changeStatus');
    Route::get('/view-Categorias/{id}', 'CategoriasController@view');
    Route::get('/filter', 'CategoriasController@filter');
});

Route::group(array('prefix' => 'Produto'), function()
{
    Route::get('/', 'ProdutoController@index');
    Route::get('/add-Produto', 'ProdutoController@add');
    Route::post('/add-Produto-post', 'ProdutoController@addPost');
    Route::get('/delete-Produto/{id}', 'ProdutoController@delete');
    Route::get('/edit-Produto/{id}', 'ProdutoController@edit');
    Route::post('/edit-Produto-post', 'ProdutoController@editPost');
    Route::get('/change-status-Produto/{id}', 'ProdutoController@changeStatus');
    Route::get('/view-Produto/{id}', 'ProdutoController@view');
    Route::get('/nome','ProdutoController@pesquisarNomeProduto');
    Route::get('/filter', 'ProdutoController@filter');
});

Route::group(array('prefix' => 'User'), function()
{
    Route::get('/', 'UserController@index');
    Route::get('/add-User', 'UserController@add');
    Route::post('/add-User-post', 'UserController@addPost');
    Route::get('/delete-User/{id}', 'UserController@delete');
    Route::get('/edit-User/{id}', 'UserController@edit');
    Route::post('/edit-User-post', 'UserController@editPost');
    Route::get('/change-status-User/{id}', 'UserController@changeStatus');
    Route::get('/view-User/{id}', 'UserController@view');
    Route::get('/filter', 'UserController@filter');
});

Route::group(array('prefix' => 'OrdemServico'), function()
{
    Route::get('/', 'OrdemServicoController@index');
    Route::get('/add-OrdemServico', 'OrdemServicoController@add');
    Route::post('/add-OrdemServico-post', 'OrdemServicoController@addPost');
    Route::get('/delete-OrdemServico/{id}', 'OrdemServicoController@delete');
    Route::get('/edit-OrdemServico/{id}', 'OrdemServicoController@edit');
    Route::post('/edit-OrdemServico-post', 'OrdemServicoController@editPost');
    Route::get('/change-status-OrdemServico/{id}', 'OrdemServicoController@changeStatus');
    Route::get('/view-OrdemServico/{id}', 'OrdemServicoController@view');
    Route::get('/filter', 'OrdemServicoController@filter');
    Route::get('/pdf/{id}', 'OrdemServicoController@pdf');
    Route::get('/email/{id}', 'OrdemServicoController@sendMailWithPDFAttached');

});

Route::group(array('prefix' => 'Cliente'), function()
{
    Route::get('/', 'ClienteController@index');
    Route::get('/add-Cliente', 'ClienteController@add');
    Route::post('/add-Cliente-post', 'ClienteController@addPost');
    Route::get('/delete-Cliente/{id}', 'ClienteController@delete');
    Route::get('/edit-Cliente/{id}', 'ClienteController@edit');
    Route::post('/edit-Cliente-post', 'ClienteController@editPost');
    Route::get('/change-status-Cliente/{id}', 'ClienteController@changeStatus');
    Route::get('/view-Cliente/{id}', 'ClienteController@view');
    Route::get('/filter', 'ClienteController@filter');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
