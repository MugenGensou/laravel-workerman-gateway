<?php

namespace Mugen\LaravelWorkermanGateway\GatewayEvents;

class Handler implements HandlerInterface
{
    public static function onConnect($clientId)
    {
    }

    public static function onMessage($clientId, $message)
    {
    }

    public static function onClose($clientId)
    {
    }
}
