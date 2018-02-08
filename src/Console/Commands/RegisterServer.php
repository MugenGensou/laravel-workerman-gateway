<?php

namespace Mugen\LaravelWorkermanGateway\Console\Commands;

use GatewayWorker\Register;
use Illuminate\Console\Command;
use Workerman\Worker;

class RegisterServer extends Command
{
    protected $signature = 'gateway:register';

    protected $description = 'Create Handler register.';

    /**
     * @var Register
     */
    protected $register;

    public function handle()
    {
        $config = config('gateway.register');

        $this->register       = new Register("text://{$config['listen_ip']}:{$config['port']}");
        $this->register->name = $config['name'];

        !defined('GLOBAL_START') && Worker::runAll();
    }
}
