<?php
/**
 * Created by aki on 2018/2/8 15:36
 */

namespace Mugen\LaravelWorkermanGateway;

use Illuminate\Support\ServiceProvider;
use Mugen\LaravelCronManager\Commands\CronManagerCommand;
use Mugen\LaravelCronManager\Server\Manager;
use Mugen\LaravelWorkermanGateway\Console\Commands\BusinessWorkerServer;
use Mugen\LaravelWorkermanGateway\Console\Commands\GatewayServeCommand;
use Mugen\LaravelWorkermanGateway\Console\Commands\GatewayServer;
use Mugen\LaravelWorkermanGateway\Console\Commands\RegisterServer;

class GatewayServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();
        $this->registerCommands();
    }

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/gateway.php' => config_path('gateway.php'),
        ], 'config');
    }

    /**
     * Merge Config
     */
    protected function mergeConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/gateway.php', 'gateway');
    }

    /**
     * Register commands.
     */
    protected function registerCommands()
    {
        $this->commands([
            RegisterServer::class,
            GatewayServer::class,
            BusinessWorkerServer::class,
            GatewayServeCommand::class,
        ]);
    }
}
