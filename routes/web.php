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

/* Basic page routes */
Route::get('/', 'PagesController@home')->name('public.home');
Route::get('/vehicles', 'PagesController@vehicles')->name('public.vehicles');
Route::get('/contact', 'PagesController@contact')->name('public.contact');

/* Administrator routes */
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');

Route::get('/admin/vehicles/', 'VehiclesController@all')->name('admin.vehicles');
Route::post('/admin/vehicles/add', 'VehiclesController@store')->name('vehicle.add');
Route::post('/admin/vehicles/{make}_{model}/edit', 'VehiclesController@edit')->name('vehicle.edit');
Route::get('/admin/vehicles/{make}_{model}/edit', 'VehiclesController@showEditForm')->name('vehicle.editForm');

Route::get('/admin/vehicles/{make}_{model}', 'VehiclesController@show')->name('vehicle.show');
Route::delete('/admin/vehicles/{make}_{model}/discontinue', 'VehiclesController@discontinue')->name('vehicle.discontinue');
Route::delete('/admin/vehicles/{make}_{model}/delete', 'VehiclesController@destroy')->name('vehicle.delete');

Route::get('/admin/reservations/', 'ReservationsController@all')->name('admin.reservations');
Route::get('/admin/hires/', 'HiresController@all')->name('admin.hires');
Route::get('/admin/vehicles/{make}_{model}/log-reservation', 'ReservationsController@showForm')->name('reservation.form');
Route::post('/admin/vehicles/{make}_{model}/log-reservation', 'ReservationsController@store')->name('reservation.log');
Route::get('/admin/vehicles/{make}_{model}/reservation-{id}/edit', 'ReservationsController@showEditForm')->name('reservation.editForm');
Route::post('/admin/vehicles/{make}_{model}/reservation-{id}/edit', 'ReservationsController@edit')->name('reservation.edit');
Route::get('/admin/vehicles/{make}_{model}/hire-{id}/edit', 'HiresController@showEditForm')->name('hire.editForm');
Route::post('/admin/vehicles/{make}_{model}/hire-{id}/edit', 'HiresController@edit')->name('hire.edit');

Route::delete('/admin/reservation-{id}/cancel', 'ReservationsController@cancel')->name('reservation.cancel');

Route::post('/admin/vehicle-rates/add', 'VehicleRatesController@store')->name('vehicle-rate.add');
Route::get('/admin/vehicle-rates/{rate}/edit', 'VehicleRatesController@showEditForm')->name('vehicle-rate.editForm');
Route::post('/admin/vehicle-rates/{rate}/edit', 'VehicleRatesController@edit')->name('vehicle-rate.edit');
Route::delete('/admin/vehicle-rates/{rate}/delete', 'VehicleRatesController@destroy')->name('vehicle-rate.delete');

/* Login routes */
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

/* Password reset routes */
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

