<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MQTTServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MqttClient::class, function ($app) {
            $server = config('mqtt.server');
            $port = config('mqtt.port');
            $clientId = config('mqtt.client_id', 'laravel-' . uniqid());

            $client = new MqttClient($server, $port, $clientId);

            $connectionSettings = (new ConnectionSettings)
                ->setUsername(config('mqtt.username'))
                ->setPassword(config('mqtt.password'))
                ->setUseTls(true)
                ->setTlsVerifyPeer(false)
                ->setTlsVerifyPeerName(false);

            $client->connect($connectionSettings, true);

            return $client;
        });
    }

    public function boot()
    {
        //
    }
}
