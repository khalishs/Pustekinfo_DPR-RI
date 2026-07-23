<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Vercel filesystem read-only kecuali /tmp.
// Paksa semua path yang butuh ditulis Laravel ke /tmp.
$tmp = '/tmp/laravel';
foreach (['', '/framework/views', '/framework/sessions', '/framework/cache/data', '/logs', '/bootstrap-cache'] as $sub) {
    @mkdir($tmp . $sub, 0775, true);
}

$envOverrides = [
    'VIEW_COMPILED_PATH' => $tmp . '/framework/views',
    'APP_CONFIG_CACHE'   => $tmp . '/bootstrap-cache/config.php',
    'APP_EVENTS_CACHE'   => $tmp . '/bootstrap-cache/events.php',
    'APP_PACKAGES_CACHE' => $tmp . '/bootstrap-cache/packages.php',
    'APP_ROUTES_CACHE'   => $tmp . '/bootstrap-cache/routes.php',
    'APP_SERVICES_CACHE' => $tmp . '/bootstrap-cache/services.php',
];
foreach ($envOverrides as $key => $value) {
    putenv("$key=$value");
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->useStoragePath($tmp);

$app->handleRequest(Request::capture());
