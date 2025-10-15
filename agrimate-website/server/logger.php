<?php

function app_log(string $event, array $context = []): void
{
    static $initialized = false;
    static $logFile;

    if (!$initialized) {
        $dir = __DIR__ . '/logs';
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
        $logFile = $dir . '/app.log';
        $initialized = true;
    }

    $entry = [
        'time'   => date('c'),
        'event'  => $event,
        'ip'     => $_SERVER['REMOTE_ADDR'] ?? null,
        'method' => $_SERVER['REQUEST_METHOD'] ?? null,
    ];

    if ($context) {
        $entry['context'] = $context;
    }

    $json = json_encode($entry, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if ($json === false) {
        $json = json_encode([
            'time'  => date('c'),
            'event' => 'log_encoding_failure',
        ]);
    }

    file_put_contents($logFile, $json . PHP_EOL, FILE_APPEND | LOCK_EX);
}
