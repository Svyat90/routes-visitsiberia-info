<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DictionaryController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\LanguageController;
use \App\Http\Controllers\Front\RouteController;
use \App\Http\Controllers\Front\PlaceController;
use \App\Http\Controllers\Front\EventController;
use \App\Http\Controllers\Front\RoomController;
use \App\Http\Controllers\Front\MealController;

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

Route::namespace('Front')->group(function () {
    Route::get('/', 'HomeController@redirectToHome');
    Route::get('home', 'HomeController@index')->name('front.home');

    Route::get('routes', [RouteController::class, 'index'])->name('front.routes.index');
    Route::get('routes/show', [RouteController::class, 'show'])->name('front.routes.show');

    Route::get('places', [PlaceController::class, 'index'])->name('front.places.index');
    Route::get('places/show', [PlaceController::class, 'show'])->name('front.places.show');

    Route::get('events', [EventController::class, 'index'])->name('front.events.index');
    Route::get('events/show', [EventController::class, 'show'])->name('front.events.show');

    Route::get('rooms', [RoomController::class, 'index'])->name('front.rooms.index');
    Route::get('rooms/show', [RoomController::class, 'show'])->name('front.rooms.show');

    Route::get('meals', [MealController::class, 'index'])->name('front.meals.index');
    Route::get('meals/show', [MealController::class, 'show'])->name('front.meals.show');
});

// Admin
Route::prefix('admin')->as('admin.')->middleware('auth')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    // Pages
    Route::resource('pages', 'Admin\PageController')->only('index', 'show', 'edit', 'update');

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
