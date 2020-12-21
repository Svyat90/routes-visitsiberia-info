<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\LanguageController;
use \App\Http\Controllers\Front\RouteController;
use \App\Http\Controllers\Admin\PlaceController as AdminPlaceController;
use \App\Http\Controllers\Admin\HotelController as AdminHotelController;
use \App\Http\Controllers\Front\EventController;
use \App\Http\Controllers\Front\RoomController;
use \App\Http\Controllers\Front\MealController;
use \App\Http\Controllers\Admin\MediaController;
use \App\Http\Controllers\Admin\DictionaryController;
use \App\Http\Controllers\Admin\Csv\ExportController;

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

Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'redirectToHome']);

Route::namespace('Front')->as('front.')->group(function () {
    Route::get('home', 'HomeController@index')->name('home');

    Route::get('routes', [RouteController::class, 'index'])->name('routes.index');
    Route::get('routes/show', [RouteController::class, 'show'])->name('routes.show');

    Route::resource('places', 'PlaceController')->only('index', 'show');

    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/show', [EventController::class, 'show'])->name('events.show');

    Route::get('rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('rooms/show', [RoomController::class, 'show'])->name('rooms.show');

    Route::get('meals', [MealController::class, 'index'])->name('meals.index');
    Route::get('meals/show', [MealController::class, 'show'])->name('meals.show');
});

// Admin
Route::prefix('admin')->as('admin.')->middleware('auth')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    // Media
    Route::post('media', [MediaController::class, 'upload'])->name('media.upload');

    // Pages
    Route::resource('pages', 'Admin\PageController')->only('index', 'show', 'edit', 'update');

    // Dictionaries
    Route::delete('dictionaries/multi-destroy', [DictionaryController::class, 'massDestroy'])->name('dictionaries.multi_destroy');
    Route::get('dictionaries/child/{dictionary_id}', [DictionaryController::class, 'indexChild'])->name('dictionaries.index.child');
    Route::resource('dictionaries', 'Admin\DictionaryController');

    // Places
    Route::delete('places/multi-destroy', [AdminPlaceController::class, 'massDestroy'])->name('places.multi_destroy');
    Route::resource('places', 'Admin\PlaceController');

    // Hotels
    Route::delete('hotels/multi-destroy', [AdminHotelController::class, 'massDestroy'])->name('hotels.multi_destroy');
    Route::resource('hotels', 'Admin\HotelController');

    // Languages
    Route::delete('languages/multi-destroy', [LanguageController::class, 'massDestroy'])->name('languages.multi_destroy');
    Route::resource('languages', 'Admin\LanguageController');

    // Translations
    Route::get('translations', [TranslationController::class, 'edit'])->name('translations.edit');
    Route::put('translations', [TranslationController::class, 'update'])->name('translations.update');

    // Change password
    Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
    Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');

    // Vars
    Route::resource('vars', 'Admin\VarController')->except('create', 'store', 'destroy');

    // Export
    Route::get('export', [ExportController::class, 'index'])->name('export.index');
    Route::post('export', [ExportController::class, 'export'])->name('export.export');
});
