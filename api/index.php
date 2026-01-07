<?php

$appStorage = '/tmp/storage';

if (!is_dir($appStorage)) {
    mkdir($appStorage, 0777, true);
    mkdir($appStorage . '/framework/views', 0777, true);
    mkdir($appStorage . '/framework/cache', 0777, true);
    mkdir($appStorage . '/framework/sessions', 0777, true);
    mkdir($appStorage . '/framework/testing', 0777, true);
    mkdir($appStorage . '/logs', 0777, true);
    mkdir($appStorage . '/app', 0777, true);
}

$_ENV['APP_STORAGE'] = $appStorage;

// $_ENV['LOG_CHANNEL'] = 'stderr';

/*
|--------------------------------------------------------------------------
| Serve The Application
|--------------------------------------------------------------------------
|
| This script is the entry point for the Vercel serverless function.
| It redirects to the public index.php but ensures the storage path
| is set correctly for a read-only filesystem environment.
|
*/

require __DIR__ . '/../public/index.php';