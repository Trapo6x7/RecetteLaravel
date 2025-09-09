<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\RecetteRepositoryInterface;
use App\Repositories\RecetteRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    $this->app->bind(RecetteRepositoryInterface::class, RecetteRepository::class);
    $this->app->bind(\App\Repositories\IngredientRepositoryInterface::class, \App\Repositories\IngredientRepository::class);
    $this->app->bind(\App\Repositories\NoteRepositoryInterface::class, \App\Repositories\NoteRepository::class);
    $this->app->bind(\App\Repositories\ReviewedRecetteRepositoryInterface::class, \App\Repositories\ReviewedRecetteRepository::class);
    $this->app->bind(\App\Repositories\UserRepositoryInterface::class, \App\Repositories\UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
