<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //User
        $this->app->bind('App\Contracts\Services\UserServiceInterface', 'App\Services\UserService');
        $this->app->bind('App\Contracts\Dao\UserDaoInterface', 'App\Dao\UserDao');

        //Auth
        $this->app->bind('App\Contracts\Services\AuthServiceInterface', 'App\Services\AuthService');

        //Post
        $this->app->bind('App\Contracts\Services\PostServiceInterface', 'App\Services\PostService');
        $this->app->bind('App\Contracts\Dao\PostDaoInterface', 'App\Dao\PostDao');

        //Comment
        $this->app->bind('App\Contracts\Services\CommentServiceInterface', 'App\Services\CommentService');
        $this->app->bind('App\Contracts\Dao\CommentDaoInterface', 'App\Dao\CommentDao');

        //Admin
        $this->app->bind('App\Contracts\Services\AdminServiceInterface', 'App\Services\AdminService');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
