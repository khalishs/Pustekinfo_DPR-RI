<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    require __DIR__ . '/../vendor/autoload.php';
    echo "✅ Autoload OK<br>";

    $app = require_once __DIR__ . '/../bootstrap/app.php';
    echo "✅ Bootstrap app OK<br>";
    echo "Class: " . get_class($app) . "<br>";

    $app->handleRequest(\Illuminate\Http\Request::capture());
    echo "✅ Request handled OK<br>";
} catch (\Throwable $e) {
    echo "❌ ERROR: " . $e->getMessage() . "<br><br>";
    echo "File: " . $e->getFile() . " (baris " . $e->getLine() . ")<br><br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
