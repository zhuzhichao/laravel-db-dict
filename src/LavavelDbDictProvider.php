<?php
namespace Zhuzhichao\LaravelDbDict;

use Illuminate\Support\ServiceProvider;
use Zhuzhichao\LaravelDbDict\Console\SyncCommand;

class LavavelDbDictProvider extends ServiceProvider
{

    /**
     * 在注册后进行服务的启动。
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'LarevelDbDict');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');

        if ( ! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['command.laravel-db-dict.sync'] = $this->app->share(function ($app) {
            return new SyncCommand($app['config']);
        });
        $this->commands([ 'command.laravel-db-dict.sync' ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ 'command.laravel-db-dict.sync' ];
    }
}