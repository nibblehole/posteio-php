<?php

namespace TorMorten\Posteio\Providers;

use TorMorten\Posteio\Client;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class PosteioServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function ($app) {
            return new Client(config('services.posteio.host'), config('services.posteio.username'), config('services.posteio.password'));
        });
        $this->app->alias(Client::class, 'posteio');
    }
}
