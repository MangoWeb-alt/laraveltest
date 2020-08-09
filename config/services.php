<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' =>[
        'client_id' => '266326077819274',
        'client_secret' => '9cc05f7194483fe80bc024ef9c9d9b03',
        'redirect' => 'http://localhost/admin/callback'
    ],
    'google' => [
        'client_id' => '361869663051-6hughek69npt9br1dapnudku3n8v87h0.apps.googleusercontent.com',
        'client_secret' => 'h_xiwC7JOpgyyv61zdTvZt2J',
        'redirect' => 'http://localhost/google/callback'
    ],

];
