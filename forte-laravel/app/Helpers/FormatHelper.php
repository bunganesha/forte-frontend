<?php

namespace App\Helpers;

/**
 * FormatHelper: Helper untuk formatting data
 */
class FormatHelper
{
    /**
     * Format tanggal ke format tertentu
     */
    public static function formatDate($date, string $format = 'd M Y'): ?string
    {
        if (!$date) return null;
        return \Carbon\Carbon::parse($date)->format($format);
    }

    /**
     * Format tanggal dengan waktu
     */
    public static function formatDateTime($date, string $format = 'd M Y H:i:s'): ?string
    {
        if (!$date) return null;
        return \Carbon\Carbon::parse($date)->format($format);
    }

    /**
     * Format koordinat GPS
     */
    public static function formatCoordinate(float $coordinate, int $decimals = 6): string
    {
        return number_format($coordinate, $decimals);
    }

    /**
     * Format daya (Watt, kWh, dll)
     */
    public static function formatPower(float $power, int $decimals = 2): string
    {
        if ($power >= 1000) {
            return number_format($power / 1000, $decimals) . ' kW';
        }
        return number_format($power, $decimals) . ' W';
    }

    /**
     * Format akselerasi
     */
    public static function formatAcceleration(float $acceleration, int $decimals = 2): string
    {
        return number_format($acceleration, $decimals) . ' m/s²';
    }
}
