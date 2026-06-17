<?php

$entrypointPath = str_replace('\\', '/', __DIR__);
$isServerless = getenv('VERCEL') !== false
    || getenv('AWS_LAMBDA_FUNCTION_NAME') !== false
    || getenv('LAMBDA_TASK_ROOT') !== false
    || str_starts_with($entrypointPath, '/var/task/');

if ($isServerless) {
    $tmpPath = '/tmp/laravel';

    foreach ([$tmpPath, $tmpPath.'/cache', $tmpPath.'/views'] as $path) {
        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    $serverlessCachePaths = [
        'APP_SERVICES_CACHE' => $tmpPath.'/cache/services.php',
        'APP_PACKAGES_CACHE' => $tmpPath.'/cache/packages.php',
        'APP_CONFIG_CACHE' => $tmpPath.'/cache/config.php',
        'APP_ROUTES_CACHE' => $tmpPath.'/cache/routes.php',
        'APP_EVENTS_CACHE' => $tmpPath.'/cache/events.php',
        'VIEW_COMPILED_PATH' => $tmpPath.'/views',
    ];

    foreach ($serverlessCachePaths as $key => $value) {
        if (getenv($key) === false) {
            putenv($key.'='.$value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->handleRequest(Illuminate\Http\Request::capture());