<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | This file determines the CORS (Cross-Origin Resource Sharing) settings.
    | This is particularly important when accessing the Laravel API from
    | external clients like Android, iOS, or web front-ends.
    |
    | For more details: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    // Set endpoint routes to apply CORS to
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Allow all HTTP methods (GET, POST, PUT, DELETE, etc.)
    'allowed_methods' => ['*'],

    // Allow requests from any origin
    'allowed_origins' => ['*'],

    // You can also use allowed_origins_patterns to match by regex if needed
    'allowed_origins_patterns' => [],

    // Allow all headers
    'allowed_headers' => ['*'],

    // Optional: headers exposed to the browser
    'exposed_headers' => [],

    // How long the results of a preflight request can be cached
    'max_age' => 0,

    // If you want to allow cookies or Authorization headers, set this to true
    'supports_credentials' => false,

];
