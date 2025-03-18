<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Sharing data with a specific view
        View::composer('components.frontend.main.sidebar', function ($view) {
            $view->with('categories', Category::all());
            $view->with('users', User::all());
        });

        Gate::define('crud-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

    }
}
