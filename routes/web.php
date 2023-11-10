<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');




Route::get('/', [GameController::class, 'index'])->middleware(['auth'])->name('games.index');
// Route::get('/', [GameController::class, 'index'])->middleware(['auth'])->name('games.index');

Route::post('/', [GameController::class, 'index'])->middleware(['auth'])->name('games.index');

Route::post('/games/search', [GameController::class, 'search'])->name("games.search");

Route::get('/games/add/{id}', [GameController::class, 'addFavorite'])->name("games.addFavorite");

Route::get('/games/favorites', [GameController::class, 'displayFavoriteGames'])->name("games.favorites");


Route::get('/games/remove/{id}', [GameController::class, 'removeFavoritesGame'])->name("games.removeFavorites");



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
