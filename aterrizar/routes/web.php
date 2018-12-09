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

Route::get('/home', 'HomeController@index');
Route::get('/admin', 'AdminController@index');
Route::get('/comercial', 'ComercialController@index');
Route::resource('/flights', 'FlightController');
Route::resource('/rooms', 'RoomController');
Route::resource('/cars', 'CarController');
Route::resource('/role', 'RoleController');
Route::resource('/myprofile', 'UserController');
Route::resource('/givenregistration', 'RegistrableUserController');
Route::get('/transactions', 'TransactionController@index');
Route::resource('/adminpanel', 'AdminPanelController');
Route::get('/hotels/{hotel}', 'HotelController@show')->name('hotels.show');
Route::get('/agencies/{agency}', 'CarRentalAgencyController@show')->name('agencies.show');
Route::post('/flights/search', 'FlightController@search')->name('flights.search');
Route::post('/cars/search', 'CarController@search')->name('cars.search');
Route::post('/rooms/search', 'RoomController@search')->name('rooms.search');
Route::get('/myCart', 'TransactionController@myCart')->name('myCart');
Route::get('/myShopping', 'TransactionController@myShopping');
Route::get('/completeTransaction/{id}', 'TransactionController@completeTransaction');
// Route::get('/addFlightToCart/{id}', 'TransactionController@addFlightToCart');
Route::get('/flights/addtocart/{class}/{seats}/{id}/{stop?}', 'TransactionController@addFlightToCart')->name('flights.addtocart');
