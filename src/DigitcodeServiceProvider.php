<?php

namespace Digitcode\Digitcodeflazz;

use Digitcode\Digitcodeflazz\Commands\TopupCommand;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class DigitcodeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/digitcode.php' => config_path('digitcode.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                TopupCommand::class,
            ]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/digitcode.php', 'digitcode');

        $this->app->bind(DigitcodeClient::class, function () {
            $client = new Client();
            return new DigitcodeClient($client);
        });

        $this->app->bind(DigitcodeWrapper::class, function () {
            $client = app(DigitcodeClient::class);
            return new DigitcodeWrapper($client);
        });

        $this->app->alias(DigitcodeWrapper::class, 'digitcode');
    }
}