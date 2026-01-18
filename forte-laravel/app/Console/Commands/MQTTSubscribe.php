<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\PowerLog;

class MQTTSubscribe extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe MQTT topics and store data';

    public function handle()
    {
        $mqtt = app(MqttClient::class);

        $topics = config('mqtt.topics');

        foreach ($topics as $topic) {
            $mqtt->subscribe($topic, function ($topic, $message) {
                $this->processMessage($topic, $message);
            }, 0);
        }

        $this->info('MQTT Subscriber running...');
        $mqtt->loop(true);
    }

    private function processMessage($topic, $message)
    {
        $data = json_decode($message, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Invalid MQTT JSON', compact('topic', 'message'));
            return;
        }

        $key = $this->cacheKey($topic);
        Cache::put($key, $data, now()->addMinutes(5));

        // if ($topic === 'rover/energy/data') {
        //     PowerLog::create([
        //         'voltage'     => $data['voltage'] ?? 0,
        //         'current'     => $data['current'] ?? 0,
        //         'power'       => $data['power'] ?? 0,
        //         'energy'      => $data['energy'] ?? 0,
        //         'energy_kwh'  => $data['energy_kwh'] ?? 0,
        //         'biaya_rp'    => $data['biaya_rp'] ?? 0,
        //         'timestamp'   => now(),
        //     ]);
        // }
    }

    private function cacheKey($topic)
    {
        return match ($topic) {
            'rover/energy/data' => 'mqtt_energy_data',
            'rover/gps/data'    => 'mqtt_gps_data',
            'rover/imu/data'    => 'mqtt_imu_data',
            'rover/status'     => 'mqtt_status',
            default             => 'mqtt_' . str_replace('/', '_', $topic),
        };
    }
}
