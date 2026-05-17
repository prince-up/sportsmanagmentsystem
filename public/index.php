<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->instance('request', Request::capture());

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = $app->make('request')
)->send();

$kernel->terminate($request, $response);