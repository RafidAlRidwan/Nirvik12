<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// HOME PAGE
Route::get('/', [App\Http\Controllers\User\LandingPageController::class, 'index'])->name('landingPage');

// USER LOGIN
Route::get('/user/login', [App\Http\Controllers\User\UserLoginController::class, 'login'])->name('user_login');
Route::get('/user/forget/password', [App\Http\Controllers\User\UserLoginController::class, 'password_reset']);

// USER DASHBOARD
Route::get('/user/dashboard', [App\Http\Controllers\User\UserController::class, 'index'])->name('user_dashboard');
Route::get('/user/my-profile', [App\Http\Controllers\User\UserController::class, 'view_my_profile'])->name('user_my_profile');
Route::get('/user/create', [App\Http\Controllers\User\UserController::class, 'create']);
Route::post('/user/store', 'App\Http\Controllers\User\UserController@store');
Route::post('/user/getdt', [App\Http\Controllers\User\UserController::class, 'contact_datatable']);
Route::get('/user/my-profile/edit/{id}', [App\Http\Controllers\User\UserController::class, 'edit']);
Route::get('/user/my-profile/edit-password/{id}', [App\Http\Controllers\User\UserController::class, 'edit_password']);
Route::put('/user/my-profile/update/{id}',
            [
                'as'   => 'user.update',
                'uses' => 'App\Http\Controllers\User\UserController@update'
            ]);
Route::put('/user/my-profile/update_password/{id}',
            [
                'as'   => 'user.update_password',
                'uses' => 'App\Http\Controllers\User\UserController@update_password'
            ]);
Route::get('/user/my-profile/show/{id}', [App\Http\Controllers\User\UserController::class, 'show']);


// ADMIN DASHBOARD
Route::get('/admin/dashboard', [App\Http\Controllers\Admin\AboutController::class, 'home']);
Route::get('/admin/icon', [App\Http\Controllers\Admin\AboutController::class, 'icon']);

// ABOUT MANAGEMENT
Route::get('/admin/about/setting/{id}', [App\Http\Controllers\Admin\AboutController::class, 'edit']);
Route::put('/admin/about/update/{id}',
            [
                'as'   => 'about.update',
                'uses' => 'App\Http\Controllers\Admin\AboutController@update'
            ]);

// USER MANAGEMENT
Route::get('/admin/user_management', [App\Http\Controllers\Admin\UserController::class, 'index']);
Route::post('/admin/getdata', [App\Http\Controllers\Admin\UserController::class, 'user_datatable']);
Route::get('/admin/user/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
Route::post('/admin/user/delete', [App\Http\Controllers\Admin\UserController::class, 'destroy']);

// News MANAGEMENT
Route::get('/admin/news/setting', [App\Http\Controllers\Admin\NewsController::class, 'index']);
Route::post('/admin/news/store', 'App\Http\Controllers\Admin\NewsController@store');
