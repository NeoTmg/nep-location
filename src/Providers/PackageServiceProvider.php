<?php

namespace Neo\NepLocation\Providers;

use Illuminate\Support\ServiceProvider; 

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        // You can register routes, views, migrations, etc.
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php'); 
        $this->publishes([
            __DIR__.'/../config/nep-location.php' => config_path('nep-location.php'),
        ]);
        // Publish Migrations
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations/nep-location'),
        ], 'migrations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.testpackage.make-model', function ($app) {
            return new MakeModel();
        });

        $this->commands([
            'command.testpackage.make-model',
        ]);
        // Register config, commands, or bindings
        $this->mergeConfigFrom(__DIR__.'/../config/testpackage.php', 'testpackage');
    }
}
