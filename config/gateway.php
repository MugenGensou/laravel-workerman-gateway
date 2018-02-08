<?php

return [

    /**
     * Handler Register server
     */
    'register'        => [

        /**
         * Register listen ip address. Suggest use local ip address.
         */
        'listen_ip' => env('GATEWAY_REGISTER_LISTEN_IP', '127.0.0.1'),

        /**
         * Register listen port.
         */
        'port'      => env('GATEWAY_REGISTER_PORT', 6100),

        /**
         * Register app name.
         */
        'name'      => env('GATEWAY_REGISTER_NAME', 'GatewayRegister'),
    ],

    /**
     * Handler Handler server
     */
    'gateway'         => [

        /**
         * Handler listen address.
         */
        'listen_ip'     => env('GATEWAY_GATEWAY_LISTEN_IP', '0.0.0.0'),

        /**
         * Handler listen port.
         */
        'port'          => env('GATEWAY_GATEWAY_PORT', 6200),

        /**
         * Handler app name.
         */
        'name'          => env('GATEWAY_GATEWAY_NAME', 'GatewayGateway'),

        /**
         * Handler worker numbers.
         */
        'num'           => env('GATEWAY_GATEWAY_NUM', 4),

        /**
         * Handler server local ip address. It's your gateway server intranet or extranet address.
         */
        'local_ip'      => env('GATEWAY_GATEWAY_LOCAL_IP', '127.0.0.1'),

        /**
         * Handler server intranet listen ip address port, it use 'num' port.
         */
        'start_port'    => env('GATEWAY_GATEWAY_PORT', 6200) + 1,

        /**
         * Handler server heart beat.
         */
        'ping'          => env('GATEWAY_GATEWAY_PING', true),

        /**
         * Specified Handler server heart beat interval time.
         */
        'ping_interval' => env('GATEWAY_GATEWAY_PING_INTERVAL', 25),

        /**
         * Check client origin.
         */
        'check_origin'  => env('GATEWAY_GATEWAY_CHECK_ORIGIN', false),

        /**
         * Specified client origins.
         */
        'origins'       => explode(',', env('GATEWAY_GATEWAY_ORIGINS')),
    ],

    /**
     * Handler Business worker server.
     */
    'business_worker' => [

        /**
         * Business worker app name.
         */
        'name'    => env('GATEWAY_BUSINESS_WORKER_NAME', 'GatewayBusinessWorker'),

        /**
         * Business worker numbers.
         */
        'num'     => env('GATEWAY_BUSINESS_WORKER_NUM', 4),

        /**
         * Business worker handler event.
         */
        'handler' => env('GATEWAY_BUSINESS_WORKER_HANDLER', 'Mugen\\LaravelWorkermanGateway\\GatewayEvents\\Handler'),
    ],
];