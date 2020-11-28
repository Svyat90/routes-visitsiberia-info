<?php

namespace App\Providers;

use App\Repositories\LanguageRepository;
use App\Services\LanguageService;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

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
