<?php

namespace App\Providers;


use App\Models\Book;
use App\Models\User;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Book\EloquentBookRepository;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        // User
        $app->bind(UserRepositoryInterface::class, function ($app) {
            return new EloquentUserRepository(
                new User
            );
        });

        // Book
        $app->bind(BookRepositoryInterface::class, function ($app) {
            return new EloquentBookRepository(
                new Book
            );
        });


    }
}
