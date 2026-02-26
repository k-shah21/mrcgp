<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Credentials (Static / Hardcoded)
    |--------------------------------------------------------------------------
    |
    | These credentials are used for the lightweight admin login.
    | ADMIN_PASSWORD must be a bcrypt hash — generate with:
    |   php artisan tinker --execute="echo bcrypt('Admin@123');"
    |
    */

    'email'    => env('ADMIN_EMAIL', 'admin@complyeze.com'),
    'password' => env('ADMIN_PASSWORD_HASH'),
];
