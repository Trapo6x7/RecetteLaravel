<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetteController;


Route::get('/', [RecetteController::class, 'showRandom'])->name('recettes.random');
Route::get('/recettes/show/{id}', [RecetteController::class, 'show'])->name('recettes.show');
Route::post('/recettes/{id}/rate', [RecetteController::class, 'rate'])->name('recettes.rate');
Route::post('/recettes/{id}/reviewed', [RecetteController::class, 'reviewed'])->name('recettes.reviewed');
