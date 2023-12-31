<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something  great!
|
*/

//Initialising Localisation for the program
Route::group(['middleware' => 'locale'], function () {

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['reset' => true]);
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'admin'], function() {

    Route::get('/admin', function() {
        return view('admin.index');
    });

    Route::resource('admin/users', 'AdminUsersController', ['names' => [
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit'
    ]]);

    Route::resource('cars/fuels', 'CarFuelController', ['names' => [
        'index' => 'cars.fuels.index',
        'store' => 'cars.fuels.store',
        'edit'  => 'cars.fuels.edit',
    ]]);

    Route::resource('cars/types', 'CarTypeController', ['names' => [
        'index' => 'cars.types.index',
        'store' => 'cars.types.store',
        'edit'  => 'cars.types.edit',
    ]]);

    Route::resource('cars/gearboxes', 'CarGearboxController', ['names' => [
        'index' => 'cars.gearboxes.index',
        'store' => 'cars.gearboxes.store',
        'edit'  => 'cars.gearboxes.edit',
    ]]);

    Route::resource('cars', 'CarController', ['names' => [
        'index' => 'cars.index',
        'create' => 'cars.create',
        'store' => 'cars.store',
        'edit' => 'cars.edit',
    ]]);

    Route::resource('branches', 'CarBranchController', ['names' => [
        'index' => 'cars.branches.index',
        'create' => 'cars.branches.create',
        'store' => 'cars.branches.store',
        'edit' => 'cars.branches.edit',
    ]]);
    Route::get('car-reservations', ['as' => 'rent-a-car.show', 'uses'=>'RentalCarsController@display']);


});


//Logged In Users ie Customers
Route::group(['middleware' => 'auth'], function() {

    /* My account */
    Route::get('user/my-account', ['as' => 'user.user-profile', 'uses'=> 'RentalCarsController@user_profile']);
    Route::get('user/my-account/edit', ['as' => 'user.user-edit', 'uses'=> 'RentalCarsController@user_edit']);
    Route::post('user/my-account', 'RentalCarsController@user_update');
    Route::get('user/my-account/reservations', ['as' => 'user.user-reservations', 'uses'=> 'RentalCarsController@user_reservations']);

});


//Rent car ie Reservation
Route::resource('rental-cars', 'RentalCarsController', ['names' => [
    'store' => 'rent-a-car.store',
    'edit' => 'rent-a-car.edit',
]]);



Route::get('/', ['as' => 'rent-a-car.search-car', 'uses'=> 'RentalCarsController@search']);
Route::get('choose-car', ['as' => 'rent-a-car.choose-car', 'uses'=> 'RentalCarsController@choose_car']);
Route::get('additional-services', ['as' => 'rent-a-car.additional-services', 'uses'=> 'RentalCarsController@additional_services']);
Route::get('final-step', ['as' => 'rent-a-car.final-step', 'uses'=> 'RentalCarsController@final_step']);
Route::get('completed-reservation', ['as' => 'rent-a-car.completed-reservation', 'uses'=> 'RentalCarsController@completed_reservation']);


});

