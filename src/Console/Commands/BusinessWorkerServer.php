<?php

namespace Mugen\LaravelWorkermanGateway\Console\Commands;

use GatewayWorker\BusinessWorker;
use Illuminate\Console\Command;
use Mugen\LaravelWorkermanGateway\Exceptions\HandlerError;
use Mugen\LaravelWorkermanGateway\GatewayEvents\EventsInterface;
use Mugen\LaravelWorkermanGateway\GatewayEvents\HandlerInterface;
use ReflectionClass;
use Workerman\Worker;

class BusinessWorkerServer extends Command
{
    protected $signature = 'gateway:business-worker';

    protected $description = 'Create Handler business worker.';

    /**
     * @var BusinessWorker
     */
    protected $worker;

    public function handle()
    {
        $config         = config('gateway.business_worker');
        $registerConfig = config('gateway.register');

        $this->worker = new BusinessWorker();

        $this->worker->name            = $config['name'];
        $this->worker->count           = $config['num'];
        $this->worker->registerAddress = "{$registerConfig['listen_ip']}:{$registerConfig['port']}";

        throw_if(!class_exists($config['handler']), HandlerError::class, 'Handler not exists.');
        throw_if(!in_array(HandlerInterface::class, (new ReflectionClass($config['handler']))->getInterfaceNames()), HandlerError::class, 'Handler must instanceof ' . HandlerInterface::class);

        $this->worker->eventHandler = $config['handler'];

        if (!defined('GLOBAL_START')) {
            Worker::runAll();
        }
    }
}
