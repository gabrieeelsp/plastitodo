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

Route::get('/enviarPeticion', [
  'uses' => 'WebserviceController@enviarPeticion',
  'as' => 'WebserviceController.enviarPeticion'
]);
Route::get('/enviarPeticionAdd', [
  'uses' => 'WebserviceController@enviarPeticionOtro',
  'as' => 'WebserviceController.enviarPeticionAdd'
]);






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
Route::resource('payments', 'Admin\PaymentController');
Route::resource('rubros', 'Admin\RubroController');
Route::resource('categories', 'Admin\CategoryController');

Route::resource('proveedors', 'Admin\ProveedorController');
Route::resource('proveedors.purchaseproducts', 'Admin\PurchaseproductController');

Route::get('search_client','Admin\ClientController@search_client');
Route::resource('clients', 'Admin\ClientController');

//-- DEBITNOTE BEGIN ---------------------------------
  Route::post('debitnotes/{id}/set_tipo_comprobante', [
    'uses' => 'Admin\DebitnoteController@set_tipo_comprobante',
    'as' => 'debitnotes.set_tipo_comprobante'
  ]);
  Route::post('debitnotes/{id}/update_client', [
    'uses' => 'Admin\DebitnoteController@update_client',
    'as' => 'debitnotes.update_client'
  ]);
  Route::post('debitnotes/{id}/guardar', [
    'uses' => 'Admin\DebitnoteController@guardar',
    'as' => 'debitnotes.guardar'
  ]);
  Route::put('debitnotes/{id}/confirm_payment_efectivo', [
    'uses' => 'Admin\DebitnoteController@confirm_payment_efectivo',
    'as' => 'debitnotes.confirm_payment_efectivo'
  ]);


  Route::get('debitnotes_search_item','Admin\SaleControllera@search');
  Route::resource('debitnotes', 'Admin\DebitnoteController');
  Route::resource('debitnotes.debitnoteitems', 'Admin\DebitnoteController');
//-- DEBITNOTE END ---------------------------------

//-- CREDITNOTE BEGIN ---------------------------------
  Route::post('creditnotes/{id}/set_tipo_comprobante', [
    'uses' => 'Admin\CreditnoteController@set_tipo_comprobante',
    'as' => 'creditnotes.set_tipo_comprobante'
  ]);
  Route::post('creditnotes/{id}/update_client', [
    'uses' => 'Admin\CreditnoteController@update_client',
    'as' => 'creditnotes.update_client'
  ]);
  Route::post('creditnotes/{id}/guardar', [
    'uses' => 'Admin\CreditnoteController@guardar',
    'as' => 'creditnotes.guardar'
  ]);
  Route::put('creditnotes/{id}/confirm_payment_efectivo', [
    'uses' => 'Admin\CreditnoteController@confirm_payment_efectivo',
    'as' => 'creditnotes.confirm_payment_efectivo'
  ]);


  Route::get('creditnotes_search_item','Admin\SaleControllera@search');
  Route::resource('creditnotes', 'Admin\CreditnoteController');
  Route::resource('creditnotes.creditnoteitems', 'Admin\CreditnoteitemController');
//-- CREDITNOTE END ---------------------------------

//-- SALE BEGIN ---------------------------------
  Route::post('sales/{id}/set_tipo_comprobante', [
    'uses' => 'Admin\SaleControllera@set_tipo_comprobante',
    'as' => 'sales.set_tipo_comprobante'
  ]);
  Route::post('sales/{id}/update_client', [
    'uses' => 'Admin\SaleControllera@update_client',
    'as' => 'sales.update_client'
  ]);
  Route::post('sales/{id}/confirm_payment_multiple', [
    'uses' => 'Admin\SaleControllera@confirm_payment_multiple',
    'as' => 'sales.confirm_payment_multiple'
  ]);
  Route::put('sales/{id}/confirm_payment_efectivo', [
    'uses' => 'Admin\SaleControllera@confirm_payment_efectivo',
    'as' => 'sales.confirm_payment_efectivo'
  ]);
  Route::post('sales/{id}/confirm_payment_cc', [
    'uses' => 'Admin\SaleControllera@confirm_payment_cc',
    'as' => 'sales.confirm_payment_cc'
  ]);
  Route::post('sales/{id}/set_multipagos', [
    'uses' => 'Admin\SaleControllera@set_multipagos',
    'as' => 'sales.set_multipagos'
  ]);
  Route::post('sales/{id}/cancel_multipagos', [
    'uses' => 'Admin\SaleControllera@cancel_multipagos',
    'as' => 'sales.cancel_multipagos'
  ]);

  Route::get('sales_search_item','Admin\SaleControllera@search');
  Route::resource('sales', 'Admin\SaleControllera');
  Route::resource('sales.saleitems', 'Admin\SaleitemControllera');
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
