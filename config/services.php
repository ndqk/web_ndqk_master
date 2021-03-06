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
    'facebook' => [
        'client_id' => '2789602067991272',
        'client_secret' => '7931ccbf21d19904c1ed43e4343757d0',
        'redirect' => 'http://127.0.0.1:8000/callback',
    ],

    'google' => [
        'client_id' => '151229220863-ijhum299v8418uud32f4071td69r8cn9.apps.googleusercontent.com',
        'client_secret' => 'XD6n19Snz915aFNBHo5cUQnW',
        'redirect' => 'http://127.0.0.1:8000/callback/google',
    ],

];
