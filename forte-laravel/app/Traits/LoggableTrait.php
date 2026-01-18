<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

/**
 * LoggableTrait: Trait untuk logging activity
 * Dapat digunakan di model atau service untuk track activities
 */
trait LoggableTrait
{
    /**
     * Log informasi
     */
    public function logInfo(string $message, array $context = []): void
    {
        Log::info($message, $this->buildContext($context));
    }

    /**
     * Log warning
     */
    public function logWarning(string $message, array $context = []): void
    {
        Log::warning($message, $this->buildContext($context));
    }

    /**
     * Log error
     */
    public function logError(string $message, array $context = []): void
    {
        Log::error($message, $this->buildContext($context));
    }

    /**
     * Log debug
     */
    public function logDebug(string $message, array $context = []): void
    {
        Log::debug($message, $this->buildContext($context));
    }

    /**
     * Build context dengan class name
     */
    protected function buildContext(array $context = []): array
    {
        return array_merge(
            ['class' => static::class],
            $context
        );
    }
}
