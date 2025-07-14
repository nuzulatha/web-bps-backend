<?php
return [

    'paths' => ['api/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:5173',
        'http://127.0.0.1:5173',
        'https://web-bps-frontend-v5th.vercel.app',
    ],

    'allowed_origins_patterns' => ['/^https:\/\/web-bps-frontend-.*\.vercel\.app$/'],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];
?>