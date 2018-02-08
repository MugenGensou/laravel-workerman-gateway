<?php

namespace Mugen\LaravelWorkermanGateway;

use GatewayClient\Gateway as GatewayClient;
use Illuminate\Notifications\Notification;

class GatewaySingleChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toGateway($notifiable);
        $message = is_array($message) ? json_encode($message) : (string)$message;

        $registerConfig = config('gateway.register');

        GatewayClient::$registerAddress = $registerConfig['listen_ip'] . ':' . $registerConfig['port'];
        GatewayClient::sendToUid($notifiable->getKey(), $message);
    }
}
