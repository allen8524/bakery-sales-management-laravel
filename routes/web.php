<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BestController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CrosstabController;
use App\Http\Controllers\FindproductController;
use App\Http\Controllers\GiganController;
use App\Http\Controllers\GubunController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JangbuiController;
use App\Http\Controllers\JangbuoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\EnsureMemberIsAdmin;
use App\Http\Middleware\EnsureUserIsLoggedIn;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('login/check', [LoginController::class, 'check'])->name('login.check');
Route::get('login/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::middleware([EnsureUserIsLoggedIn::class])->group(function () {
    Route::middleware([EnsureMemberIsAdmin::class])->group(function () {
        Route::resource('member', MemberController::class);
    });

    Route::resource('gubun', GubunController::class);

    Route::get('product/jaego', [ProductController::class, 'jaego'])->name('product.jaego');
    Route::resource('product', ProductController::class);

    Route::resource('jangbui', JangbuiController::class);
    Route::resource('jangbuo', JangbuoController::class);
    Route::resource('findproduct', FindproductController::class)->only(['index']);

    Route::get('gigan/excel', [GiganController::class, 'excel'])->name('gigan.excel');
    Route::resource('gigan', GiganController::class)->only(['index']);

    Route::resource('best', BestController::class)->only(['index']);
    Route::resource('crosstab', CrosstabController::class)->only(['index']);
    Route::resource('chart', ChartController::class)->only(['index']);
    Route::resource('picture', PictureController::class)->only(['index']);
    Route::resource('ajax', AjaxController::class)->only(['index', 'store', 'update', 'destroy']);
});
