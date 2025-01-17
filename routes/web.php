<?php

use App\Http\Controllers\FilmController;
use App\Http\Middleware\validateUrl;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('year')->group(function() {
    Route::group(['prefix'=>'filmout'], function(){
        // Routes included with prefix "filmout"
        Route::get('oldFilms/{year?}',[FilmController::class, "listOldFilms"])->name('oldFilms');
        Route::get('newFilms/{year?}',[FilmController::class, "listNewFilms"])->name('newFilms');
        Route::get('filmsByGenre/{genre}',[FilmController::class, "listFilmsByGenre"])->name('listFilmsByGenre');
        Route::get('filmsByYear/{year}',[FilmController::class, "listFilmsByYear"])->name('listFilmsByYear');
        Route::get('films',[FilmController::class, "listFilms"])->name('listFilms');
        Route::get('sortFilms',[FilmController::class, "sortFilms"])->name('sortFilms');
        Route::get('countFilms',[FilmController::class, "countFilms"])->name('countFilms');
        Route::delete('deleteFilm/{id}', [FilmController::class, 'deleteFilm'])->name('deleteFilm');
        Route::middleware('validate.url')->group(function () {
            Route::put('updateFilm', [FilmController::class, 'updateFilm'])->name('updateFilm');
            Route::post('createFilm',[FilmController::class, "createFilm"])->prefix('filmin')->name('createFilm');
        });
    });
});


