<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/recettes', [RecetteController::class, 'showRandom'])->name('recettes.random');
Route::get('/recettes/{id}', [RecetteController::class, 'show'])->name('recettes.show');
Route::post('/recettes/{id}/rate', [RecetteController::class, 'rate'])->name('recettes.rate');
Route::post('/recettes/{id}/reviewed', [RecetteController::class, 'reviewed'])->name('recettes.reviewed');

require __DIR__.'/auth.php';
