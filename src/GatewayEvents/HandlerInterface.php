<?php

namespace Mugen\LaravelWorkermanGateway\GatewayEvents;

interface HandlerInterface
{
    public static function onMessage($clientId, $message);
}
