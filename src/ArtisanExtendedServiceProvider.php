<?php

namespace Mateusjatenee\LaravelArtisanExtended;

use Illuminate\Support\ServiceProvider;
use Mateusjatenee\LaravelArtisanExtended\Commands\MakeTransformerCommand;

class ArtisanExtendedServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMakeTransformerCommand();
    }

    /**
     * Register the make:transformer command.
     */
    protected function registerMakeTransformerCommand()
    {
        $this->app->singleton('command.mateusjatenee.make.transformer', function ($app) {
            return $app[MakeTransformerCommand::class];
        });

        $this->commands('command.mateusjatenee.make.transformer');
    }
}
