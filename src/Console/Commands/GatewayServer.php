<?php

namespace Mugen\LaravelWorkermanGateway\Console\Commands;

use GatewayWorker\Gateway;
use Illuminate\Console\Command;
use Workerman\Connection\TcpConnection;
use Workerman\Worker;

class GatewayServer extends Command
{
    protected $signature = 'gateway:gateway';

    protected $description = 'Create Handler gateway.';

    /**
     * @var Gateway
     */
    protected $gateway;

    public function handle()
    {
        $config         = config('gateway.gateway');
        $registerConfig = config('gateway.register');

        $this->gateway = new Gateway("websocket://{$config['listen_ip']}:{$config['port']}");

        $this->gateway->name            = $config['name'];
        $this->gateway->count           = $config['num'];
        $this->gateway->lanIp           = $config['local_ip'];
        $this->gateway->startPort       = $config['start_port'];
        $this->gateway->registerAddress = "{$registerConfig['listen_ip']}:{$registerConfig['port']}";

        if ($config['ping']) {
            $this->ping($config['ping_interval'], ['event' => 'ping']);
        }

        $this->gateway->onConnect = [$this, 'onConnect'];

        if (!defined('GLOBAL_START')) {
            Worker::runAll();
        }
    }

    public function ping(int $interval, array $data)
    {
        $this->gateway->pingInterval = $interval;
        $this->gateway->pingData     = json_encode($data);
    }

    public function onConnect(TcpConnection $connection)
    {
        $connection->onWebSocketConnect = function (TcpConnection $connection, string $header) {
            $config = config('gateway.gateway');

            if ($config['check_origin'] && !in_array($_SERVER['HTTP_ORIGIN'], $config['origins']))
                $connection->close();
        };
    }
}
