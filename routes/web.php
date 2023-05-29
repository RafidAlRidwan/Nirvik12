<?php

use App\Http\Middleware\IsUser;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\IsAuthUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\SocialAuthController;

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
Route::get('/album/create', [App\Http\Controllers\User\LandingPageController::class, 'albumCreate'])->name('albumCreate');
Route::get('/blog', [App\Http\Controllers\User\BlogPageController::class, 'index'])->name('blog');
Route::get('/blog/create', [App\Http\Controllers\User\BlogPageController::class, 'create'])->name('blogCreate');
Route::get('/blog/edit/{blog}', [App\Http\Controllers\User\BlogPageController::class, 'edit'])->name('blogEdit');
Route::get('/blog/{blog}', [App\Http\Controllers\User\BlogPageController::class, 'show'])->name('blog.show');
Route::get('/blogs-filter', [App\Http\Controllers\User\BlogPageController::class, 'blogsFilter'])->name('blog.filter');
Route::get('/public/committee/view', [App\Http\Controllers\User\LandingPageController::class, 'committee'])->name('committeePage');
Route::get('/gallery/{id}', [App\Http\Controllers\User\LandingPageController::class, 'gallery'])->name('galleryPage');
Route::post('/public/committee/getdata', [App\Http\Controllers\User\LandingPageController::class, 'datatable']);
Route::get('/public/committee/details/{id}', [App\Http\Controllers\User\LandingPageController::class, 'show']);
Route::get('/public/committee/others/{id}', [App\Http\Controllers\User\LandingPageController::class, 'others']);
Route::get('/public/committee/registration/{id}', [App\Http\Controllers\User\LandingPageController::class, 'registration']);
Route::post('/public/registration/getdata/{id}', [App\Http\Controllers\User\LandingPageController::class, 'registrationDatatable']);
Route::post('/blog/read/count', [App\Http\Controllers\User\BlogPageController::class, 'countRead'])->name('blog.read.count');
Route::post('/sender-msg', [App\Http\Controllers\User\LandingPageController::class, 'storeMessage'])->name('sender.msg');

// Social Sign in
Route::get('auth/google', [SocialAuthController::class, "redirectGoogle"])->name('auth.google');
Route::get('auth/facebook', [SocialAuthController::class, "redirectFacebook"])->name('auth.facebook');
Route::get('auth/google/callback', [SocialAuthController::class, "callBackGoogle"]);
Route::get('auth/facebook/callback', [SocialAuthController::class, "callBackFacebook"]);
Route::post('store/google/user', [SocialAuthController::class, "store"])->name('store.google.user');

// USER LOGIN
Route::middleware([IsAuthUser::class])->group(function () {
    Route::get('/user/login', [App\Http\Controllers\User\UserloginController::class, 'login'])->name('user_login');
});
Route::get('/user/forget/password', [App\Http\Controllers\User\UserloginController::class, 'password_reset']);
Route::get('/user/dashboard', [App\Http\Controllers\User\UserController::class, 'index'])->name('user_dashboard');

// USER DASHBOARD
Route::middleware([IsUser::class])->group(function () {
    Route::post('/blog/store', [App\Http\Controllers\User\BlogPageController::class, 'store'])->name('blog.store');
    Route::post('/blog/like', [App\Http\Controllers\User\BlogPageController::class, 'liked'])->name('blog.like');
    Route::post('/comment/store', [App\Http\Controllers\User\BlogPageController::class, 'storeComment'])->name('comment.store');
    Route::post('/comment/edit', [App\Http\Controllers\User\BlogPageController::class, 'editComment'])->name('comment.edit');
    Route::post('/comment/update', [App\Http\Controllers\User\BlogPageController::class, 'updateComment'])->name('comment.update');
    Route::get('/user/my-profile', [App\Http\Controllers\User\UserController::class, 'view_my_profile'])->name('user_my_profile');
    Route::post('/crop-image-upload', [App\Http\Controllers\User\UserController::class, 'uploadCropImage'])->name('profile.image.upload');
    Route::get('/user/create', [App\Http\Controllers\User\UserController::class, 'create']);
    Route::post('/user/store', [App\Http\Controllers\User\UserController::class, 'store']);
    Route::get('/user/getdata', [App\Http\Controllers\User\UserController::class, 'loadUserData'])->name('load.data');
    Route::post('/user/getdt', [App\Http\Controllers\User\UserController::class, 'contact_datatable']);
    Route::get('/user/my-profile/edit/{id}', [App\Http\Controllers\User\UserController::class, 'edit'])->name('profile.edit');
    Route::get('/user/my-profile/edit-password/{id}', [App\Http\Controllers\User\UserController::class, 'edit_password']);
    Route::put(
        '/user/my-profile/update/{id}',
        [
            'as'   => 'user.update',
            'uses' => 'App\Http\Controllers\User\UserController@update'
        ]
    );
    Route::put(
        '/user/my-profile/update_password/{id}',
        [
            'as'   => 'user.update_password',
            'uses' => 'App\Http\Controllers\User\UserController@update_password'
        ]
    );
    Route::get('/user/my-profile/edit-testimonial/{id}', [App\Http\Controllers\User\UserController::class, 'edit_testimonial']);

    Route::post(
        '/user/my-profile/update_testimonial',
        [
            'as'   => 'user.update_testimonial',
            'uses' => 'App\Http\Controllers\User\UserController@update_testimonial'
        ]
    );
    Route::get('/user/my-profile/show/{id}', [App\Http\Controllers\User\UserController::class, 'show'])->name('myProfile');
    Route::get('/user/committee', [App\Http\Controllers\User\CommitteeController::class, 'index']);
    Route::post('/user/committee/getdata', [App\Http\Controllers\User\CommitteeController::class, 'datatable']);
    Route::get('/user/committee/memberView/{id}', [App\Http\Controllers\User\CommitteeController::class, 'memberShow']);
    Route::get('/user/committee/others/{id}', [App\Http\Controllers\User\CommitteeController::class, 'others']);
    Route::get('/user/committee/collectionView/{id}', [App\Http\Controllers\User\CommitteeController::class, 'collectionShow']);
    Route::get('/user/committee/expenseView/{id}', [App\Http\Controllers\User\CommitteeController::class, 'expenseShow']);
    Route::get('/user/committee/fundTransferView/{id}', [App\Http\Controllers\User\CommitteeController::class, 'fundTransferShow']);
    Route::post('/user/collection/getdata/{id}', [App\Http\Controllers\User\CommitteeController::class, 'collectionDatatable']);
    Route::post('/user/expense/getdata/{id}', [App\Http\Controllers\User\CommitteeController::class, 'expenseDatatable']);
    Route::post('/user/fundTransfer/getdata/{id}', [App\Http\Controllers\User\CommitteeController::class, 'fundTransferDatatable']);
    Route::post('/user/collection/store', 'App\Http\Controllers\User\CommitteeController@store');
    Route::post('/user/collection/destroy', 'App\Http\Controllers\User\CommitteeController@destroy');
    Route::post('/user/expense/store', 'App\Http\Controllers\User\CommitteeController@expenseStore');
    Route::post('/user/image/upload', 'App\Http\Controllers\User\UserController@imageUpload');
    Route::get('/user/collection/getBalance/{userId?}/{committeeId?}', [App\Http\Controllers\User\CommitteeController::class, 'getBalanceData']);
    Route::post('/user/collection/transfer', 'App\Http\Controllers\User\CommitteeController@transfer');
    Route::get('/user/donate', 'App\Http\Controllers\User\DonateController@index');
    Route::post('/user/donate/store', [App\Http\Controllers\User\DonateController::class, 'store'])->name('store.donor');
});
// USER SECTION END


// ADMIN SECTION START
// ADMIN DASHBOARD
Route::middleware([CheckAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\AboutController::class, 'home']);
    Route::get('/admin/icon', [App\Http\Controllers\Admin\AboutController::class, 'icon']);

    // ABOUT MANAGEMENT
    Route::get('/admin/about/setting/{id}', [App\Http\Controllers\Admin\AboutController::class, 'edit']);
    Route::put(
        '/admin/about/update/{id}',
        [
            'as'   => 'about.update',
            'uses' => 'App\Http\Controllers\Admin\AboutController@update'
        ]
    );

    // USER MANAGEMENT
    Route::get('/admin/user_management', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin_user_index');
    Route::post('/admin/getdata', [App\Http\Controllers\Admin\UserController::class, 'user_datatable']);
    Route::post('/admin/user/store', [App\Http\Controllers\Admin\UserController::class, 'store']);
    Route::get('/admin/user/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::get('/admin/user/show/{id}', [App\Http\Controllers\Admin\UserController::class, 'show']);
    Route::post('/admin/user/delete', [App\Http\Controllers\Admin\UserController::class, 'destroy']);
    Route::post('/admin/user/email', [App\Http\Controllers\Admin\UserController::class, 'sendEmail']);
    Route::put(
        '/user/update/{id}',
        [
            'as'   => 'admin.user.update',
            'uses' => 'App\Http\Controllers\Admin\UserController@update'
        ]
    );
    Route::post('/admin/user/import', [App\Http\Controllers\Admin\UserController::class, 'importPost'])->name('import');

    // News MANAGEMENT
    Route::get('/admin/news/setting', [App\Http\Controllers\Admin\NewsController::class, 'index'])->name('news_index');;
    Route::post('/admin/news/store', 'App\Http\Controllers\Admin\NewsController@store');
    Route::post('/admin/news/getdata', [App\Http\Controllers\Admin\NewsController::class, 'news_datatable']);
    Route::post('/admin/news/update', 'App\Http\Controllers\Admin\NewsController@update');
    Route::get('/admin/news/show/{id}', [App\Http\Controllers\Admin\NewsController::class, 'show']);
    Route::post('/admin/news/destroy', 'App\Http\Controllers\Admin\NewsController@destroy');
    Route::post('/admin/news/getEditdata', [App\Http\Controllers\Admin\NewsController::class, 'getEditData'])->name('news.edit.data');
    Route::post('/admin/trending/news/store', 'App\Http\Controllers\Admin\NewsController@updateTrendingNews');

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
    Route::get('/admin/committee/view-others/{id}', [App\Http\Controllers\Admin\CommitteeController::class, 'showOthers']);

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

    // Sponsor MANAGEMENT
    Route::get('/admin/sponsor/setting', [App\Http\Controllers\Admin\SponsorController::class, 'index'])->name('sponsor_index');
    Route::get('/admin/sponsor/create', [App\Http\Controllers\Admin\SponsorController::class, 'create']);
    Route::post('/admin/sponsor/store', 'App\Http\Controllers\Admin\SponsorController@store');
    Route::post('/admin/sponsor/getdata', [App\Http\Controllers\Admin\SponsorController::class, 'sponsor_datatable']);
    Route::post('/admin/sponsor/destroy', 'App\Http\Controllers\Admin\SponsorController@destroy');

    // Blog MANAGEMENT
    Route::get('/admin/blog/setting', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('blog_index');
    Route::post('/admin/blog/getdata', [App\Http\Controllers\Admin\BlogController::class, 'blog_datatable']);
    Route::get('/admin/blog/view/{id}', [App\Http\Controllers\Admin\BlogController::class, 'show']);
    Route::post('/admin/blog/destroy', 'App\Http\Controllers\Admin\BlogController@destroy');
    Route::post('/admin/blog/modify-status', [App\Http\Controllers\Admin\BlogController::class, 'modifyStatus'])->name('blog.status.modify');

    // Donate MANAGEMENT
    Route::get('/admin/donate/setting', [App\Http\Controllers\Admin\DonateController::class, 'index'])->name('donate_index');
    Route::get('/admin/donate/edit/{donate}', [App\Http\Controllers\Admin\DonateController::class, 'edit']);
    Route::post('/admin/donate/update', 'App\Http\Controllers\Admin\DonateController@update');
    Route::post('/admin/donate/getdata', [App\Http\Controllers\Admin\DonateController::class, 'donate_datatable']);
    Route::post('/admin/donate/destroy', 'App\Http\Controllers\Admin\DonateController@destroy');
    Route::post('/admin/donate/modify-status', [App\Http\Controllers\Admin\DonateController::class, 'modifyStatus'])->name('donate.status.modify');

    // Responsiblity Section MANAGEMENT
    Route::get('/admin/responsiblity-section/setting', [App\Http\Controllers\Admin\ResponsiblityController::class, 'index'])->name('responsiblity_index');
    Route::get('/admin/responsiblity-section/create', [App\Http\Controllers\Admin\ResponsiblityController::class, 'create']);
    Route::post('/admin/responsiblity-section/store', 'App\Http\Controllers\Admin\ResponsiblityController@store');
    Route::post('/admin/responsiblity-section/getdata', [App\Http\Controllers\Admin\ResponsiblityController::class, 'responsiblity_datatable']);
    Route::get('/admin/responsiblity-section/edit/{id}', [App\Http\Controllers\Admin\ResponsiblityController::class, 'edit']);
    Route::post('/admin/responsiblity-section/update', 'App\Http\Controllers\Admin\ResponsiblityController@update');
    Route::get('/admin/responsiblity-section/show/{id}', [App\Http\Controllers\Admin\ResponsiblityController::class, 'show']);
    Route::post('/admin/responsiblity-section/destroy', 'App\Http\Controllers\Admin\ResponsiblityController@destroy');

    Route::get('/user/sync', [App\Http\Controllers\Admin\UserController::class, 'insertData']);

    // Settings
    Route::get('/admin/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('setting_index');
    Route::post('/admin/settings/update', [App\Http\Controllers\Admin\SettingsController::class, 'update']);
});
// ADMIN SECTION END

Route::get("/email", function () {
    return View::make("admin.send-email");
});
