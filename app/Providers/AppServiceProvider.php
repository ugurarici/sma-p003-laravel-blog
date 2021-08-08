<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Mahmut\Muarrem;
use App\Models\Category;
use Cmfcmf\OpenWeatherMap;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use Illuminate\Support\Facades\View;

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
        View::share('isim', 'Uğur Arıcı');
        try {
            View::share('menuCategories', Category::all());
        } catch (\Throwable $th) {
            View::share('menuCategories', []);
        }
    }
}
