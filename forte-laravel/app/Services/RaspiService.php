<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * RaspiService: Menangani komunikasi dengan Raspberry Pi
 * Mengikuti Single Responsibility Principle
 */
class RaspiService
{
    private string $host;
    private string $port;
    private int $timeout = 1;

    public function __construct()
    {
        $this->host = config('services.raspi.host', 'localhost');
        $this->port = config('services.raspi.port', '8000');
    }

    /**
     * Get data terbaru dari Raspi
     */
    public function getLatestData(): array
    {
        try {
            $response = Http::timeout($this->timeout)
                ->get("{$this->getBaseUrl()}/data");

            if ($response->successful()) {
                return [
                    'status' => 'ok',
                    'data' => $response->json()
                ];
            }
        } catch (\Exception $e) {
            \Log::warning('Raspi connection failed', ['error' => $e->getMessage()]);
        }

        return [
            'status' => 'offline',
            'data' => null
        ];
    }

    /**
     * Check status kamera
     */
    public function getCameraStatus(): array
    {
        $videoUrl = "{$this->getBaseUrl()}/video";

        return [
            'front' => $this->checkCamera($videoUrl),
            'front_url' => $videoUrl,
        ];
    }

    /**
     * Check apakah kamera aktif
     */
    private function checkCamera(string $url): bool
    {
        try {
            return Http::timeout($this->timeout)->head($url)->successful();
        } catch (\Exception $e) {
            \Log::warning('Camera check failed', ['url' => $url]);
            return false;
        }
    }

    /**
     * Get base URL Raspi
     */
    private function getBaseUrl(): string
    {
        return "http://{$this->host}:{$this->port}";
    }
}
