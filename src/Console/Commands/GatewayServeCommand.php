<?php

namespace Mugen\LaravelWorkermanGateway\Console\Commands;

use Illuminate\Console\Command;
use Workerman\Worker;

class GatewayServeCommand extends Command
{
    protected $signature = 'gateway:serve {action?} {--d|daemon} {--g|gracefully}';

    protected $description = 'Start all Gateway server.';

    public function __construct()
    {
        parent::__construct();

        global $argv;

        $argv[1] = $argv[2] ?? 'start';
        $argv[2] = $argv[3] ?? '';
    }

    public function handle()
    {
        define('GLOBAL_START', 1);

        $this->call('gateway:register');
        $this->call('gateway:gateway');
        $this->call('gateway:business-worker');

        Worker::runAll();
    }
}
