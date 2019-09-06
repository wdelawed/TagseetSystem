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

Auth::routes();

Route::get('/', 'EmployeesController@index')->name('home');

            Route::get('/roles','RolesController@index') ;
    Route::post('/roles/update','RolesController@update') ;
    Route::post('/roles/create','RolesController@create') ;
Route::get('/roles/delete/{id}','RolesController@delete') ;
   Route::get('/roles/get/{id}','RolesController@get') ;
    Route::get('/roles/refresh','RolesController@refresh') ;


Route::get('/employees','EmployeesController@index') ;
Route::post('/employees/update','EmployeesController@update') ;
Route::post('/employees/create','EmployeesController@create') ;
Route::post('/employees/search','EmployeesController@search') ;
Route::get('/employees/delete/{id}','EmployeesController@delete') ;
Route::get('/employees/get/{id}','EmployeesController@get') ;
Route::get('/employees/refresh','EmployeesController@refresh') ;



            Route::get('/customers','CustomersController@index') ;
    Route::post('/customers/update','CustomersController@update') ;
    Route::post('/customers/create','CustomersController@create') ;
    Route::post('/customers/search','CustomersController@search') ;
Route::get('/customers/delete/{id}','CustomersController@delete') ;
   Route::get('/customers/get/{id}','CustomersController@get') ;
    Route::get('/customers/refresh','CustomersController@refresh') ;


            Route::get('/sponsors','SponsorsController@index') ;
    Route::post('/sponsors/update','SponsorsController@update') ;
    Route::post('/sponsors/create','SponsorsController@create') ;
    Route::post('/sponsors/search','SponsorsController@search') ;
Route::get('/sponsors/delete/{id}','SponsorsController@delete') ;
   Route::get('/sponsors/get/{id}','SponsorsController@get') ;
    Route::get('/sponsors/refresh','SponsorsController@refresh') ;

            Route::get('/custodies','CustodyController@index') ;
    Route::post('/custodies/update','CustodyController@update') ;
    Route::post('/custodies/create','CustodyController@create') ;
    Route::post('/custodies/search','CustodyController@search') ;
Route::get('/custodies/delete/{id}','CustodyController@delete') ;
   Route::get('/custodies/get/{id}','CustodyController@get') ;
    Route::get('/custodies/refresh','CustodyController@refresh') ;

            Route::get('/oplog','OperationsController@index') ;
    Route::post('/oplog/search','OperationsController@search') ;