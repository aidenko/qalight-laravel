<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
        'client_id' => 'f44a6f5c8c0460707976',
        'client_secret' => '321d5bd58d72d3a6c47ecb4819e6bd3bf87a4b8d',
        'redirect' => 'http://qalight-laravel.app/auth/github/callback',
    ],

    'facebook' => [
        'client_id' => '1313023828812481',
        'client_secret' => '0c90b74eb634568ae66450d3a390d735',
        'redirect' => 'http://qalight-laravel.app/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => '1052030622483-jn00igaron3n631fv285ms7g6uajr2bb.apps.googleusercontent.com',
        'client_secret' => 'cJEQwo45GAAhk75EEQ6sBqhk',
        'redirect' => 'http://qalight-laravel.app/auth/google/callback',
    ],

];
