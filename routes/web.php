<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\WalletController;

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
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
//     // return Inertia::render('Dashboard');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');
Route::get('/', function() {
    return Redirect::route('markets.index');
});

Route::middleware('auth:sanctum')->group(function(){

    Route::prefix('home')->group(function() {
        Route::get('/', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        // Only Admin can access it
        Route::resource('users', UserController::class)->middleware('role:admin');

        // Available for all
        Route::get('/market', [MarketController::class, 'index'])->name('markets.index');
        Route::get('/market/{id}', [MarketController::class, 'show'])->name('markets.show');


        // Only Client
        Route::middleware('role:client')->group(function(){
            Route::post('/wallet', [WalletController::class, 'buy'])->name('wallet.buy');
            Route::patch('/wallet/sell', [WalletController::class, 'sellAll'])->name('wallet.sell.all');
            Route::patch('/wallet/sell/{id}', [WalletController::class, 'sell'])->name('wallet.sell.one');
            Route::get('/mywallet/{id}', [WalletController::class, 'index'])->name('wallet.index');
            Route::get('/mywallet/{user_id}/market/{crypto_id}', [WalletController::class, 'show'])->name('wallet.show');
        });



    });

});
