<?php

return [
    'apps' => [
        [
            'id' => env('REVERB_APP_ID', 'local'),
            'key' => env('REVERB_APP_KEY', 'local'),
            'secret' => env('REVERB_APP_SECRET', 'local-secret'),
            'options' => [
                'host' => env('REVERB_HOST', '127.0.0.1'),
                'port' => (int) env('REVERB_PORT', 8081),
                'scheme' => env('REVERB_SCHEME', 'http'),
            ],
            'allowed_origins' => ['*'],
        ],
    ],

    'scaling' => [
        'enabled' => false,
    ],
];