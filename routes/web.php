<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DictionaryController;

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

Auth::routes([
    'register' => false
]);

Route::get('/', function () {
    return view('welcome');
});

// Admin
Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::resource('dictionaries', 'Admin\DictionaryController');
    Route::get('dictionaries/child/{dictionary_id}', [DictionaryController::class, 'indexChild'])->name('dictionaries.index.child');
    Route::delete('dictionaries/destroy', [DictionaryController::class, 'massDestroy'])->name('dictionaries.mass_destroy');

    // Change password
    Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
    Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
});
