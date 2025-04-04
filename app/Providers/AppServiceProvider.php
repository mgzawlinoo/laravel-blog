<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Laravel\Sanctum\Sanctum;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;

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
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        Paginator::useBootstrapFive();

        // Sharing data with a specific view
        View::composer('components.frontend.main.sidebar', function ($view) {
            $view->with('categories', Category::get());
            $view->with('users', User::get());
            $view->with('tags', Tag::get());
        });

        Gate::define('crud-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        // Prevent lazy loading
        // eg foreach loop
        // \Illuminate\Database\Eloquent\Model::preventLazyLoading();

    }
}
