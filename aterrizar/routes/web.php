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
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index');
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
Route::get('/myShopping', 'TransactionController@myShopping')->name('myShopping');
Route::get('/flights/addtocart/{class}/{seats}/{id}/{stop?}', 'TransactionController@addFlightToCart')->name('flights.addtocart');
Route::get('/cars/addtocart/{id}/{dateRent}/{dateReturn}/{returnCityId}', 'TransactionController@addCarToCart')->name('cars.addtocart');
Route::get('/transactions/removefromcart/{id}', 'TransactionController@removeFromCart')->name('transactions.removefromcart');
Route::get('/transactions/clearcart', 'TransactionController@clearCart')->name('transactions.clearcart');
Route::get('/transactions/checkout', 'TransactionController@checkout')->name('transactions.checkout');
Route::post('/transactions/checkout/confirm', 'TransactionController@confirmCheckout')->name('transactions.confirmcheckout');
Route::get('/transactions/cancel/{id}', 'TransactionController@cancel')->name('transactions.cancel');
Route::get('/rooms/addtocart/{id}/{from}/{to}/{capacity}', 'TransactionController@addRoomToCart')->name('rooms.addtocart');

