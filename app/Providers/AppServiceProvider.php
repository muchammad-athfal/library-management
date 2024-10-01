<?php

namespace App\Providers;

use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\Interfaces\AuthorInterface;
use App\Repositories\Interfaces\BookInterface;
use App\Services\AuthorService;
use App\Services\BookService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthorInterface::class,
            AuthorRepository::class,
        );

        $this->app->bind(
            BookInterface::class,
            BookRepository::class,
        );

        $this->app->bind(AuthorService::class, function ($app) {
            return new AuthorService($app->make(AuthorInterface::class));
        });

        $this->app->bind(BookService::class, function ($app) {
            return new BookService($app->make(BookInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
