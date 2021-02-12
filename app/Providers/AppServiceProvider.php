<?php

namespace App\Providers;

use App\Repositories\LanguageRepository;
use App\Services\LanguageService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LanguageService::class, function ($app) {
            $repository = new LanguageRepository();
            return new LanguageService($repository);
        });

        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
