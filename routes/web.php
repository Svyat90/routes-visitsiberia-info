<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\LanguageController;
use \App\Http\Controllers\Admin\PlaceController as AdminPlaceController;
use \App\Http\Controllers\Admin\HotelController as AdminHotelController;
use \App\Http\Controllers\Admin\MealController as AdminMealController;
use \App\Http\Controllers\Admin\EventController as AdminEventController;
use \App\Http\Controllers\Admin\RouteController as AdminRouteController;
use \App\Http\Controllers\Admin\MediaController;
use \App\Http\Controllers\Admin\DictionaryController;
use \App\Http\Controllers\Admin\Csv\ExportController;
use \App\Http\Middleware\LocaleMiddleware;

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
Route::get('set-locale/{lang}', 'Front\LocaleController@setLocale')->name('set_locate');

Route::prefix(LocaleMiddleware::getLocale())->namespace('Front')->as('front.')->group(function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('favourites', 'FavouriteController@index')->name('favourites');
    Route::get('choose', 'ConstructorController@choose')->name('choose');
    Route::get('constructor', 'ConstructorController@constructor')->name('constructor');
    Route::resource('places', 'PlaceController')->only('index', 'show');
    Route::resource('hotels', 'HotelController')->only('index', 'show');
    Route::resource('meals', 'MealController')->only('index', 'show');
    Route::resource('events', 'EventController')->only('index', 'show');
    Route::resource('routes', 'RouteController')->only('index', 'show');
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

    // Meals
    Route::delete('meals/multi-destroy', [AdminMealController::class, 'massDestroy'])->name('meals.multi_destroy');
    Route::resource('meals', 'Admin\MealController');

    // Events
    Route::delete('events/multi-destroy', [AdminEventController::class, 'massDestroy'])->name('events.multi_destroy');
    Route::resource('events', 'Admin\EventController');

    // Routes
    Route::delete('routes/multi-destroy', [AdminRouteController::class, 'massDestroy'])->name('routes.multi_destroy');
    Route::resource('routes', 'Admin\RouteController');

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
