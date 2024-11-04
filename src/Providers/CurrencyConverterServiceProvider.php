<?php

namespace Hutchh\CurrencyConverter\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Hutchh\CurrencyConverter\Handler;
use Illuminate\Support\Facades\Log;
use Hutchh\CurrencyConverter\Managers;


class CurrencyConverterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/currency.php', 'currency');

        $this->app->singleton('currency.client', function ($app) {
            Log::info('Iam Here');
            return (new Managers\CurrencyConverterManager($app))->driver();
        });

        $this->app->bind('currency.handler', function ($app) {
            $client = $app[ 'currency.client' ];
            Log::info('Iam Here');
            return new Handler\CurrencyHandler($client);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Str::contains($this->app->version(), 'Lumen')) {
            $this->app->configure('currency');
        } else {
            $this->publishes([
                __DIR__.'/../../config/currency.php' => config_path('currency.php'),
            ]);
        }
    }
}
