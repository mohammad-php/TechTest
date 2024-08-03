<?php

namespace App\Providers;

use App\Models\Article;
use App\Observers\ArticleCreateObserver;
use App\Observers\ArticleUpdateObserver;
use App\Services\AWS\LambdaClientService;
use App\Services\AWS\LambdaInvoker;
use App\Services\AWS\LambdaNotificationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LambdaClientService::class);
        $this->app->singleton(LambdaInvoker::class);
        $this->app->singleton(LambdaNotificationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Article::observe([
            ArticleCreateObserver::class,
            ArticleUpdateObserver::class,
        ]);
    }
}
