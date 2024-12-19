<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'accounts',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Here, you define all the authentication guards for your application.
    | This example utilizes session storage with the accounts provider.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'accounts',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database. This example uses
    | the accounts table via Eloquent.
    |
    | Supported: "eloquent", "database"
    |
    */

    'providers' => [
        'accounts' => [
            'driver' => 'eloquent',
            'model' => App\Models\Account::class, // Ensure this model exists
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | This configuration specifies the behavior of Laravel's password reset
    | functionality, including the table used for token storage.
    |
    */

    'passwords' => [
        'accounts' => [
            'provider' => 'accounts',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Defines the time before a password confirmation window expires.
    |
    */

    'password_timeout' => 10800,
];
