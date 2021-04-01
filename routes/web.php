<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mainController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\UserController;
use App\http\Controllers\GenreController;
use Illuminate\Support\Facades\Request;
use APP\Models\Movie;
use App\http\Controllers\RatingController;

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
    return view('index');
});

Route::get('/movies', function () {
    return view('movies');
});


Route::get('/register', function () {
    return view('register');
});

// ------ search -----
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/searchfail', [SearchController::class, 'search'])->name('searchfail');


Route::delete('/watchlist/{id}', [WatchlistController::class, 'destroy']);

Route::get('/', [MovieController::class, 'movieCarousel']);

//Movies information
Route::get('/movie/{id}', [mainController::class, 'getInfo'])->name('movie');
Route::post('/movie/{id}', [mainController::class, 'store']);
//Each Genre Information

Route::get('/genre/{id}', [GenreController::class, 'genre']);
Route::get('/genre-list', [GenreController::class, 'genreList']);

//Storage to the DB
Route::post('/save', [mainController::class, 'save'])->name('save');
//Check in the DB
Route::post('/check', [mainController::class, 'check'])->name('check');

//General session breaker..
Route::get('logout', [mainController::class, 'logout'])->name('logout');

//AuthCheck controller..
Route::group(['middleware' => ['authCheck']], function () {

    //Here should we add all files to force the user to be logged in.
    //Remeber to update authCheck middleware (only the pages located here)!!
    Route::get('/login',    [mainController::class, 'login'])->name('login');
    Route::get('/register', [mainController::class, 'register'])->name('register');

    //User Panel
    Route::get('/user',     [mainController::class, 'profile']);
    Route::get('/user/settings',    [mainController::class, 'settings']);
    Route::get('/user/mywatchs',    [mainController::class, 'mywatchs']);
    Route::get('/user/myratings',   [mainController::class, 'myratings']);
    Route::get('/user/mymovies',    [mainController::class, 'mymovies']);

    // Watchlist
    Route::get('/watchlist', [WatchlistController::class, 'show']);
    Route::post('/watchlist/{id}', [WatchlistController::class, 'store']);
    Route::delete('/watchlist/{id}', [WatchlistController::class, 'destroy']);

    // Rating
    Route::post('/{id}/rating', [RatingController::class,'store'])->name('rating');

    // Review
    Route::post('review/{id}', [mainController::class, 'store']);
});
