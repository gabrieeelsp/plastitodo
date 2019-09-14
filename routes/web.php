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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/','SearchController@index');

Route::get('search','SearchController@search');

Route::get('/starter', function () {
    return view('layouts.starter');
});

Route::get('/date', function () {
    return view('date');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Admin
//
Route::resource('rubros', 'Admin\RubroController');
Route::resource('categories', 'Admin\CategoryController');

Route::resource('proveedors', 'Admin\ProveedorController');
Route::resource('proveedors.purchaseproducts', 'Admin\PurchaseproductController');

Route::resource('clients', 'Admin\ClientController');

//-- SALE BEGIN ---------------------------------
  Route::post('sales/{id}/update_client', [
    'uses' => 'Admin\SaleController@update_client',
    'as' => 'sales.update_client'
  ]);
  Route::get('sales_search_client','Admin\SaleController@search_client');
  Route::get('sales_search_item','Admin\SaleController@search');
  Route::resource('sales', 'Admin\SaleController');
  Route::resource('sales.saleitems', 'Admin\SaleitemController');
//-- SALE END ---------------------------------

//-- STOCK PRODUCT BEGIN ---------------------------------
  Route::get('existencias', [
    'uses' => 'Admin\StockproductController@existencias',
    'as' => 'stockproducts.existencias'
  ]);
  Route::post('stockproducts/{id}/update_costo', [
    'uses' => 'Admin\StockproductController@update_costo',
    'as' => 'stockproducts.update_costo'
  ]);
  Route::resource('stockproducts', 'Admin\StockproductController');
//-- STOCK PRODUCT END ---------------------------------

//-- SALE PRODUCT BEGIN ---------------------------------
  Route::get('lista_de_precios', [
    'uses' => 'Admin\SaleproductController@index',
    'as' => 'saleproducts.lista_de_precios'
  ]);
  /*
  Route::get('lista_de_precios', [
    'uses' => 'Admin\SaleproductController@lista_de_precios',
    'as' => 'saleproducts.lista_de_precios'
  ]);
  */

  Route::post('lista_de_precios/saleproducts/{id}/update_valores', [
    'uses' => 'Admin\SaleproductController@update_valores',
    'as' => 'saleproducts.lista_de_precios.update_valores'
  ]);

  /*
  Route::post('stockproducts/{stockproduct_id}/saleproducts/{id}/update_costo', [
    'uses' => 'Admin\SaleproductController@update_costo',
    'as' => 'stockproducts.saleproducts.update_costo'
  ]);
  */
  Route::resource('stockproducts.saleproducts', 'Admin\SaleproductController');
//-- SALE PRODUCT END ---------------------------------
