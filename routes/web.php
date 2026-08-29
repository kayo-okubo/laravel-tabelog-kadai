<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Subscribed;
use App\Http\Middleware\NotSubscribed;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SubscriptionController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::get('/', [ShopController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::get('home', [Admin\HomeController::class, 'index'])->name('home');

    Route::get('users', [Admin\UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [Admin\UserController::class, 'show'])->name('users.show');

    Route::resource('shops', Admin\ShopController::class);

    Route::resource('categories', Admin\CategoryController::class)->only(['index', 'store', 'update', 'destroy']);
});

Route::resource('shops', ShopController::class)->only(['index', 'show']);

Route::middleware(['auth', 'verified'])->group(function () 
{

    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('users/mypage/favorite', [FavoriteController::class, 'index'])->name('mypage.favorite');

    Route::post('favorites/{shop_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{shop_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::resource('reservations', ReservationController::class);

    Route::controller(UserController::class)->group(function () {
        Route::get('users/mypage', 'mypage')->name('mypage');
        Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
        Route::put('users/mypage', 'update')->name('mypage.update');
        Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
        Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
    });
    Route::middleware('guest:admin')->group(function () {

        Route::group(['middleware' => [NotSubscribed::class]], function(){
            Route::get('subscription/create', [SubscriptionController::class, 'create'])
                ->name('subscription.create');

            Route::post('subscription', [SubscriptionController::class, 'store'])
                ->name('subscription.store');
        });

        Route::group(['middleware' => [Subscribed::class]], function(){
            Route::get('subscription/edit', [SubscriptionController::class, 'edit'])
                ->name('subscription.edit');

            Route::patch('subscription', [SubscriptionController::class, 'update'])
                ->name('subscription.update');

            Route::get('subscription/cancel', [SubscriptionController::class, 'cancel'])
                ->name('subscription.cancel');

            Route::delete('subscription', [SubscriptionController::class, 'destroy'])
                ->name('subscription.destroy');
        });

    });
});

