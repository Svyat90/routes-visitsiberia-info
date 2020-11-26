<?php

namespace App\Providers;

use App\Repositories\LanguageRepository;
use App\Services\LanguageService;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
