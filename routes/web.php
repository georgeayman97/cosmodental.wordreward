<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Artisan;
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
//     return redirect()->route('dashboard');
// })->middleware('admin');
Route::group(['middleware' => 'admin'], function () {
	// Admin Dashboard
	Route::get('/', function () {
        return redirect()->route('dashboard');
    });	
});
Route::get('/privacypolicy', function () {
    return view('policy');
})->name('policy');

Route::middleware('admin')->get('/dashboard', [DashboardController::class, 'index'])
->name('dashboard');

Route::get('search', [UserController::class, 'search'])
    ->name('search');

Route::get('migratefresh', function () {
//    Artisan::call('migrate:fresh');
//    dump('migrated');
    Artisan::call('db:seed');
    dd('seeded');
});

Route::get('seed', fn () => Artisan::call('db:seed'));

Route::get('optimize', function () {
    Artisan::call('optimize');
    dd('optimized');
});
Route::get('/abc', function () {
    return view('/dashboard');
});

require __DIR__.'/auth.php';

require __DIR__.'/dashboard.php';
