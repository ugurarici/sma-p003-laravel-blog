<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Mahmut\Muarrem;
use Cmfcmf\OpenWeatherMap;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Muarrem::class, function ($app) {
            return new Muarrem(config('muarrem.artist'));
        });


        $this->app->singleton(OpenWeatherMap::class, function ($app) {
            return new OpenWeatherMap(
                config('services.openweathermap.api_key'),
                $app->make(Client::class),
                $app->make(HttpFactory::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
