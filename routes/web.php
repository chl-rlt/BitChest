<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;

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
    return Redirect::route('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    Route::prefix('dashboard')->group(function() {
        Route::get('/', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        Route::resource('users', UserController::class);
        Route::get('/market', 'MarketController@index');
    });

});
