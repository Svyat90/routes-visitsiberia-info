<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DictionaryController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\LanguageController;

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
Route::prefix('admin')->as('admin.')->middleware('auth')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    // Dictionaries
    Route::delete('dictionaries/multi-destroy', [DictionaryController::class, 'massDestroy'])->name('dictionaries.multi_destroy');
    Route::get('dictionaries/child/{dictionary_id}', [DictionaryController::class, 'indexChild'])->name('dictionaries.index.child');
    Route::resource('dictionaries', 'Admin\DictionaryController');

    // Languages
    Route::delete('languages/multi-destroy', [LanguageController::class, 'massDestroy'])->name('languages.multi_destroy');
    Route::resource('languages', 'Admin\LanguageController');

    // Translations
    Route::get('translations', [TranslationController::class, 'edit'])->name('translations.edit');
    Route::put('translations', [TranslationController::class, 'update'])->name('translations.update');

    // Change password
    Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
    Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
});
