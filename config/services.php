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
        'scheme' => 'https',
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
        'client_id' => env('FACEBOOK_CLIENT_ID', '82b31d1a2aca2771af82a58d71ecf605'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', '82b31d1a2aca2771af82a58d71ecf605'),
        'redirect' => env('FACEBOOK_REDIRECT_URI', 'http://localhost:8000/login/facebook/callback'),
    ],
    
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', '579557201423-f0mdfggmbllcdp6sj3ntlnb0qj49gme1.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', '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'),
        'redirect' => env('GOOGLE_REDIRECT_URI', 'http://localhost:8080/login/google/callback'),
    ],
     

];
