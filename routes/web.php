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

Auth::routes();
// USER SECTION START
// HOME PAGE
Route::get('/', [App\Http\Controllers\User\LandingPageController::class, 'index'])->name('landingPage');
Route::get('/events', [App\Http\Controllers\User\LandingPageController::class, 'event'])->name('eventPage');
Route::get('/news', [App\Http\Controllers\User\LandingPageController::class, 'news'])->name('newsPage');
Route::get('/album', [App\Http\Controllers\User\LandingPageController::class, 'album'])->name('albumPage');
Route::get('/committee', [App\Http\Controllers\User\LandingPageController::class, 'committee'])->name('committeePage');
Route::get('/gallery/{id}', [App\Http\Controllers\User\LandingPageController::class, 'gallery'])->name('galleryPage');

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
// USER SECTION END


// ADMIN SECTION START
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
Route::get('/admin/user_management', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin_user_index');
Route::post('/admin/getdata', [App\Http\Controllers\Admin\UserController::class, 'user_datatable']);
Route::get('/admin/user/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
Route::get('/admin/user/show/{id}', [App\Http\Controllers\Admin\UserController::class, 'show']);
Route::post('/admin/user/delete', [App\Http\Controllers\Admin\UserController::class, 'destroy']);
Route::put('/user/update/{id}',
            [
                'as'   => 'admin.user.update',
                'uses' => 'App\Http\Controllers\Admin\UserController@update'
            ]);

// News MANAGEMENT
Route::get('/admin/news/setting', [App\Http\Controllers\Admin\NewsController::class, 'index'])->name('news_index');;
Route::post('/admin/news/store', 'App\Http\Controllers\Admin\NewsController@store');
Route::post('/admin/news/getdata', [App\Http\Controllers\Admin\NewsController::class, 'news_datatable']);
Route::post('/admin/news/update', 'App\Http\Controllers\Admin\NewsController@update');
Route::get('/admin/news/show/{id}', [App\Http\Controllers\Admin\NewsController::class, 'show']);
Route::post('/admin/news/destroy', 'App\Http\Controllers\Admin\NewsController@destroy');

// Event MANAGEMENT
Route::get('/admin/event/setting', [App\Http\Controllers\Admin\EventController::class, 'index'])->name('event_index');
Route::get('/admin/event/create', [App\Http\Controllers\Admin\EventController::class, 'create']);
Route::post('/admin/event/store', 'App\Http\Controllers\Admin\EventController@store');
Route::post('/admin/event/getdata', [App\Http\Controllers\Admin\EventController::class, 'news_datatable']);
Route::get('/admin/event/edit/{id}', [App\Http\Controllers\Admin\EventController::class, 'edit']);
Route::post('/admin/event/update', 'App\Http\Controllers\Admin\EventController@update');
Route::get('/admin/event/show/{id}', [App\Http\Controllers\Admin\EventController::class, 'show']);
Route::post('/admin/event/destroy', 'App\Http\Controllers\Admin\EventController@destroy');

// GALLERY MANAGEMENT
Route::get('/admin/gallery/setting', [App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('gallery_index');
Route::get('/admin/gallery/create', [App\Http\Controllers\Admin\GalleryController::class, 'create']);
Route::post('/admin/gallery/store', 'App\Http\Controllers\Admin\GalleryController@store');
Route::post('/admin/gallery/getdata', [App\Http\Controllers\Admin\GalleryController::class, 'news_datatable']);
Route::get('/admin/gallery/edit/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'edit']);
Route::post('/admin/gallery/update', 'App\Http\Controllers\Admin\GalleryController@update');
Route::get('/admin/gallery/show/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'show']);
Route::post('/admin/gallery/destroy', 'App\Http\Controllers\Admin\GalleryController@destroy');

// ALBUM MANAGEMENT
Route::get('/admin/album/setting', [App\Http\Controllers\Admin\AlbumController::class, 'index'])->name('album_index');
Route::post('/admin/album/store', 'App\Http\Controllers\Admin\AlbumController@store');
Route::get('/admin/album/edit/{id}', [App\Http\Controllers\Admin\AlbumController::class, 'edit']);
Route::post('/admin/album/update', 'App\Http\Controllers\Admin\AlbumController@update');
Route::post('/admin/album/destroy', 'App\Http\Controllers\Admin\AlbumController@destroy');

// COVER PAGE MANAGEMENT
Route::get('/admin/cover-page/setting', [App\Http\Controllers\Admin\CoverPageController::class, 'index'])->name('cover_page_index');
Route::get('/admin/cover-page/create', [App\Http\Controllers\Admin\CoverPageController::class, 'create']);
Route::post('/admin/cover-page/store', 'App\Http\Controllers\Admin\CoverPageController@store');
Route::get('/admin/cover-page/edit/{id}', [App\Http\Controllers\Admin\CoverPageController::class, 'edit']);
Route::post('/admin/cover-page/update', 'App\Http\Controllers\Admin\CoverPageController@update');
Route::post('/admin/cover-page/destroy', 'App\Http\Controllers\Admin\CoverPageController@destroy');

// COMMITTEE MANAGEMENT
Route::get('/admin/committee/setting', [App\Http\Controllers\Admin\CommitteeController::class, 'index'])->name('committee_index');
Route::get('/admin/committee/create', [App\Http\Controllers\Admin\CommitteeController::class, 'create']);
Route::post('/admin/committee/store', 'App\Http\Controllers\Admin\CommitteeController@store');
Route::post('/admin/committee/getdata', [App\Http\Controllers\Admin\CommitteeController::class, 'datatable']);
Route::get('/admin/committee/edit/{id}', [App\Http\Controllers\Admin\CommitteeController::class, 'edit']);
Route::post('/admin/committee/update', 'App\Http\Controllers\Admin\CommitteeController@update');
Route::post('/admin/committee/destroy', 'App\Http\Controllers\Admin\CommitteeController@destroy');
Route::get('/admin/committee/getUserData/{id}', [App\Http\Controllers\Admin\CommitteeController::class, 'getUserIds']);
Route::get('/admin/committee/view/{id}', [App\Http\Controllers\Admin\CommitteeController::class, 'show']);

// COLLECTION MANAGEMENT
Route::post('/admin/collection/store', 'App\Http\Controllers\Admin\CollectionController@store');
Route::post('/admin/collection/getdata/{id}', [App\Http\Controllers\Admin\CollectionController::class, 'datatable']);
Route::post('/admin/collection/destroy', 'App\Http\Controllers\Admin\CollectionController@destroy');
Route::post('/admin/collection/transfer', 'App\Http\Controllers\Admin\CollectionController@transfer');
Route::get('/admin/collection/getBalance/{userId?}/{committeeId?}', [App\Http\Controllers\Admin\CollectionController::class, 'getBalanceData']);
Route::post('/admin/fundTransfer/getdata/{id}', [App\Http\Controllers\Admin\CollectionController::class, 'transfer_datatable']);
Route::post('/admin/expense/getdata/{id}', [App\Http\Controllers\Admin\CollectionController::class, 'expense_datatable']);
Route::post('/admin/collection/fundDestroy', 'App\Http\Controllers\Admin\CollectionController@fundDestroy');
Route::post('/admin/collection/expenseStore', 'App\Http\Controllers\Admin\CollectionController@expenseStore');


// Settings
Route::get('/admin/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('setting_index');
Route::post('/admin/settings/update', [App\Http\Controllers\Admin\SettingsController::class, 'update']);


// ADMIN SECTION END
