<?php

namespace App\Services;

use Carbon\Carbon;
use JsonException;
use Log;

class LogService
{
    public static function error(string $file, string $method, string $error, int $line = null, string $detail = null): void
    {
        $log = [
            'timestamp' => Carbon::now()->toDateTimeString(),
            'file' => $file,
            'method' => $method,
            'error' => $error,
            'line' => $line,
            'detail' => $detail
        ];
        try {
            $json = json_encode($log, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            Log::error('Error encoding log JSON. ' . $e->getMessage());
        }
        Log::error($json);
    }
}
