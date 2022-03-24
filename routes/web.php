<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Auth;

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

Route::get('cache', function () {

    \Artisan::call('cache:clear');
    \Artisan::call('config:cache');

    dd("Cache is cleared");
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });
    Route::middleware(['auth:admin'])->group(function () {
        // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'], function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


        Route::get('/profile', [App\Http\Controllers\HomeController::class, 'userProfile'])->name('profile');
        Route::post('/profile', [App\Http\Controllers\HomeController::class, 'userProfileSave'])->name('profile.save');
        // Route::get('user/change/password','HomeController@changePassword')->name('user.changepassword');
        Route::post('admin/change/password', [App\Http\Controllers\HomeController::class, 'updateUserPassword'])->name('changepassword.save');

        // ---------------Interest--------------

        Route::get('/interest', [App\Http\Controllers\Admin\InterestController::class, 'index'])->name('interest.index');
        Route::get('/interest/create', [App\Http\Controllers\Admin\InterestController::class, 'create'])->name('interest.create');
        Route::post('/interest/store', [App\Http\Controllers\Admin\InterestController::class, 'store'])->name('interest.store');
        Route::get('/interest/edit/{id}', [App\Http\Controllers\Admin\InterestController::class, 'edit'])->name('interest.edit');
        Route::post('/interest/update/{id}', [App\Http\Controllers\Admin\InterestController::class, 'update'])->name('interest.update');
        Route::get('/interest/delete/{id}', [App\Http\Controllers\Admin\InterestController::class, 'destroy'])->name('interest.delete');
        Route::post('/interest/updateStatus', [App\Http\Controllers\Admin\InterestController::class, 'updateStatus'])->name('interest.updateStatus');

        // ---------------Event--------------

        Route::get('/event', [App\Http\Controllers\Admin\EventController::class, 'index'])->name('event.index');
        Route::get('/event/create', [App\Http\Controllers\Admin\EventController::class, 'create'])->name('event.create');
        Route::post('/event/store', [App\Http\Controllers\Admin\EventController::class, 'store'])->name('event.store');
        Route::get('/event/edit/{id}', [App\Http\Controllers\Admin\EventController::class, 'edit'])->name('event.edit');
        Route::post('/event/update/{id}', [App\Http\Controllers\Admin\EventController::class, 'update'])->name('event.update');
        Route::get('/event/delete/{id}', [App\Http\Controllers\Admin\EventController::class, 'destroy'])->name('event.delete');
        Route::post('/event/updateStatus', [App\Http\Controllers\Admin\EventController::class, 'updateStatus'])->name('event.updateStatus');

        // ---------------------Team---------------------------

        Route::get('/team', [App\Http\Controllers\Admin\TeamController::class, 'index'])->name('team.index');
        Route::get('/team/create', [App\Http\Controllers\Admin\TeamController::class, 'create'])->name('team.create');
        Route::post('/team/store', [App\Http\Controllers\Admin\TeamController::class, 'store'])->name('team.store');
        Route::get('/team/edit/{id}', [App\Http\Controllers\Admin\TeamController::class, 'edit'])->name('team.edit');
        Route::post('/team/update/{id}', [App\Http\Controllers\Admin\TeamController::class, 'update'])->name('team.update');
        Route::get('/team/delete/{id}', [App\Http\Controllers\Admin\TeamController::class, 'destroy'])->name('team.delete');


        // ---------------------Banner---------------------------

        Route::get('/banner', [App\Http\Controllers\Admin\BannerController::class, 'index'])->name('banner.index');
        Route::get('/banner/create', [App\Http\Controllers\Admin\BannerController::class, 'create'])->name('banner.create');
        Route::post('/banner/store', [App\Http\Controllers\Admin\BannerController::class, 'store'])->name('banner.store');
        Route::get('/banner/edit/{id}', [App\Http\Controllers\Admin\BannerController::class, 'edit'])->name('banner.edit');
        Route::post('/banner/update/{id}', [App\Http\Controllers\Admin\BannerController::class, 'update'])->name('banner.update');
        Route::get('/banner/delete/{id}', [App\Http\Controllers\Admin\BannerController::class, 'destroy'])->name('banner.delete');
        Route::post('/banner/updateStatus', [App\Http\Controllers\Admin\BannerController::class, 'updateStatus'])->name('banner.updateStatus');




        //-----------------Announcement----------------

        Route::get('/announcement', [App\Http\Controllers\Admin\AnnouncementController::class, 'index'])->name('announcement.index');
        Route::get('/announcement/create', [App\Http\Controllers\Admin\AnnouncementController::class, 'create'])->name('announcement.create');
        Route::post('/announcement/store', [App\Http\Controllers\Admin\AnnouncementController::class, 'store'])->name('announcement.store');
        Route::get('/announcement/edit/{id}', [App\Http\Controllers\Admin\AnnouncementController::class, 'edit'])->name('announcement.edit');
        Route::post('/announcement/update/{id}', [App\Http\Controllers\Admin\AnnouncementController::class, 'update'])->name('announcement.update');
        Route::get('/announcement/delete/{id}', [App\Http\Controllers\Admin\AnnouncementController::class, 'destroy'])->name('announcement.delete');
        Route::post('/announcement/updateStatus', [App\Http\Controllers\Admin\AnnouncementController::class, 'updateStatus'])->name('announcement.updateStatus');

        //-----------------User----------------

        Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
        Route::post('/user/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update');
        Route::get('/user/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.delete');
        Route::post('/user/updateStatus', [App\Http\Controllers\Admin\UserController::class, 'updateStatus'])->name('user.updateStatus');


        //-----------------Forum----------------

        Route::get('/forum', [App\Http\Controllers\Admin\ForumController::class, 'index'])->name('forum.index');
        Route::get('/forum/show/{id}', [App\Http\Controllers\Admin\ForumController::class, 'show'])->name('forum.details');

        //-----------------Forum Comment----------------

        Route::get('/forum/comment', [App\Http\Controllers\Admin\ForumCommentController::class, 'index'])->name('forum-comment.index');
        Route::get('/forum/coment/show/{id}', [App\Http\Controllers\Admin\ForumCommentController::class, 'show'])->name('forum-comment.details');




        //   //---------------------Reword-----------------------------------

        //   Route::get('/reward', [App\Http\Controllers\Admin\RewordController::class, 'index'])->name('reword.index');
        //   // Route::get('/reword/create', [App\Http\Controllers\Admin\RewordController::class, 'create'])->name('reword.create');
        //   // Route::post('/reword/store', [App\Http\Controllers\Admin\RewordController::class, 'store'])->name('reword.store');
        //   Route::get('/reward/edit/{id}', [App\Http\Controllers\Admin\RewordController::class, 'edit'])->name('reword.edit');
        //   Route::post('/reward/update', [App\Http\Controllers\Admin\RewordController::class, 'update'])->name('reword.update');
        //   // Route::get('/reword/delete/{id}', [App\Http\Controllers\Admin\RewordController::class, 'destroy'])->name('reword.delete');
        //   Route::post('/reward/updateStatus', [App\Http\Controllers\Admin\RewordController::class, 'updateStatus'])->name('reword.updateStatus');

        // // ------------------------Reword Report-----------------------
        //   Route::get('/reward-report', [App\Http\Controllers\Admin\RewardReportController::class, 'index'])->name('reward-report.index');
        //   // Route::get('/reward-report/create', [App\Http\Controllers\Admin\AnnouncementController::class, 'create'])->name('announcement.create');
        //   // Route::post('/reward-report/store', [App\Http\Controllers\Admin\AnnouncementController::class, 'store'])->name('announcement.store');
        //   Route::get('/reward-report/details/{id}', [App\Http\Controllers\Admin\RewardReportController::class, 'show'])->name('reward-report.details');
        //   // Route::post('/reward-report/update', [App\Http\Controllers\Admin\AnnouncementController::class, 'update'])->name('announcement.update');
        //   // Route::get('/reward-report/delete/{id}', [App\Http\Controllers\Admin\AnnouncementController::class, 'destroy'])->name('announcement.delete');
        //   // Route::post('/reward-report/updateStatus', [App\Http\Controllers\Admin\AnnouncementController::class, 'updateStatus'])->name('announcement.updateStatus');
    });

    // Route::get('/', function () {
    //     return view('admin/dashboard');
    // });


});










// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::middleware(['guest:admin'])->group(function () {
//         Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
//         Route::post('/login', [LoginController::class, 'login']);
//     });
//     Route::middleware(['auth:admin'])->group(function () {
//         Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//         Route::get('dashboard', function () {
//             return view('admin.dashboard');
//         })->name('admin.dashboard');
//     });

//     Route::post('/logout', [LoginController::class, 'login']);
//     //-----------------Interest---------------------



// });