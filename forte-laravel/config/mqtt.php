<?php

return [
    'server' => env('MQTT_SERVER', '419f776cc00341318db8984ee188f2f9.s1.eu.hivemq.cloud'),
    'port' => env('MQTT_PORT', 8883),
    'username' => env('MQTT_USERNAME', 'rover-praktikum'),
    'password' => env('MQTT_PASSWORD', 'roverPraktikum13'),
    'client_id' => env('MQTT_CLIENT_ID', 'laravel-' . uniqid()),

    'topics' => [
        'energy' => 'rover/energy/data',
        'gps' => 'rover/gps/data',
        'imu' => 'rover/imu/data',
        'status' => 'rover/status',
    ],
];
