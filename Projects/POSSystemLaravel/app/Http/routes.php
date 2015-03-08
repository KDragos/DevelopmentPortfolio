<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/


// Route::get('home', function(){
// 	return view('home');
// 	}
Route::get('/', function(){
	return view('home');
});

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
Route::get('customer', 'CustomerController@all');
Route::get('singleCustomer/{id}', 'CustomerController@justOne');

/*
|--------------------------------------------------------------------------
| Item Routes
|--------------------------------------------------------------------------
*/
Route::get('item', 'ItemController@all');
Route::get('singleItem/{id}', 'ItemController@justOne');
/*
|--------------------------------------------------------------------------
| Invoice Routes
|--------------------------------------------------------------------------
*/
Route::get('invoice', 'InvoiceController@all');
Route::get('singleInvoice/{invoice_id}', 'InvoiceController@justOne');
Route::get('removeInvoiceItem/{invoice_id}/{item_id}', 'InvoiceController@removeLineItem');
Route::get('deleteInvoice/{invoice_id}', 'InvoiceController@removeInvoice');
Route::get('addInvoice/{customer_id}', 'InvoiceController@addInvoice');
Route::get('addInvoice', 'InvoiceController@addInvoice');
Route::post('editInvoice/{invoice_id}', 'InvoiceController@editInvoice');
