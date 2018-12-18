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
    if (Auth::user() and Auth::user()->hasAnyRole(['admin', 'comercial'])) {
        return view('home');
    }
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index');

Route::get('/adminpanel', 'AdminPanelController@index')->name('adminpanel.index');
Route::post('/adminpanel', 'AdminPanelController@store')->name('adminpanel.store');

Route::get('/cars', 'CarController@index')->name('cars.index');
Route::get('/cars/create', 'CarController@create')->name('cars.create')->middleware('auth');
Route::post('/cars', 'CarController@store')->name('cars.store')->middleware('auth');
Route::post('/cars/search', 'CarController@search')->name('cars.search');
Route::get('/cars/{car}', 'CarController@show')->name('cars.show')->middleware('auth');

Route::get('/flights', 'FlightController@index')->name('flights.index');
Route::get('/flights/create', 'FlightController@create')->name('flights.create')->middleware('auth');
Route::post('/flights', 'FlightController@store')->name('flights.store')->middleware('auth');
Route::post('/flights/search', 'FlightController@search')->name('flights.search');
Route::get('/flights/{car}', 'FlightController@show')->name('flights.show')->middleware('auth');

Route::get('/rooms', 'RoomController@index')->name('rooms.index');
Route::get('/rooms/create', 'RoomController@create')->name('rooms.create')->middleware('auth');
Route::post('/rooms', 'RoomController@store')->name('rooms.store')->middleware('auth');
Route::post('/rooms/search', 'RoomController@search')->name('rooms.search');
Route::get('/rooms/{car}', 'RoomController@show')->name('rooms.show')->middleware('auth');

Route::get('/transactions', 'TransactionController@index')->name('transactions');
Route::get('/cars/addtocart/{id}/{dateRent}/{dateReturn}/{returnCityId}', 'TransactionController@addCarToCart')->name('cars.addtocart');
Route::get('/rooms/addtocart/{id}/{from}/{to}/{capacity}', 'TransactionController@addRoomToCart')->name('rooms.addtocart');
Route::get('/flights/addtocart/{class}/{seats}/{id}/{stop?}', 'TransactionController@addFlightToCart')->name('flights.addtocart');
Route::get('/transactions/removefromcart/{id}', 'TransactionController@removeFromCart')->name('transactions.removefromcart');
Route::get('/transactions/clearcart', 'TransactionController@clearCart')->name('transactions.clearcart');
Route::get('/transactions/checkout', 'TransactionController@checkout')->name('transactions.checkout');
Route::post('/transactions/checkout/confirm', 'TransactionController@confirmCheckout')->name('transactions.confirmcheckout');
Route::get('/transactions/cancel/{id}', 'TransactionController@cancel')->name('transactions.cancel');
Route::get('/myCart', 'TransactionController@myCart')->name('myCart');
Route::get('/myShopping', 'TransactionController@myShopping')->name('myShopping');

Route::get('/myprofile', 'UserController@index')->name('myprofile.index');
Route::get('/myprofile/create', 'UserController@create')->name('myprofile.create');
Route::post('/myprofile', 'UserController@store')->name('myprofile.store');

Route::get('/givenregistration', 'RegistrableUserController@index')->name('givenregistration.index');
Route::get('/givenregistration/create', 'RegistrableUserController@create')->name('givenregistration.create');
Route::post('/givenregistration', 'RegistrableUserController@store')->name('givenregistration.store');

Route::get('/hotels/{hotel}', 'HotelController@show')->name('hotels.show');
Route::get('/hotels/{hotel}/rate', 'HotelController@rate')->name('hotels.rate')->middleware('auth');
Route::post('/hotels/{hotel}/rate', 'HotelController@storeRating')->name('hotels.storeRating')->middleware('auth');

Route::get('/agencies/{agency}', 'CarRentalAgencyController@show')->name('agencies.show');

