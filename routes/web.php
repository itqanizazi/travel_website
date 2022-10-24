<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// For authentication
// -- register / login
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::view('/homepage', 'HomeController@homepage')->name('homepage');

Route::view('/show_react','show_react');

/////////////////
// ADMIN
//
Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function () {

  Route::get('/',function(){
    return redirect('/admin/dashboard');
  });

  Route::get('/dashboard', 'AdminController@index');

  Route::get('/home', 'HomeController@index')->name('dashboard');

  Route::get('/masterdetail', 'AdminController@masterdetail');


  Route::view('/react', 'admin.react');
  

  Route::resource('categories','CategoryController',['as'=>'admin']);

  Route::resource('posts','PostController',['as'=>'admin']);

  Route::resource('travel-packages','TravelPackageController',['as'=>'admin']);

  Route::resource('tasks','AdminTasksController',['as'=>'admin']);

  Route::resource('places','PlaceController',['as'=>'admin']);

  Route::resource('bookings','BookingController',['as'=>'admin']);


});
