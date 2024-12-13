<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Client bootstrap setting
    |--------------------------------------------------------------------------
    |
    | This value is the path of open-admin bootstrap file.
    |
    */
    'bootstrap' => app_path('Admin/bootstrap.php'),

    /*
    |--------------------------------------------------------------------------
    | Client route settings
    |--------------------------------------------------------------------------
    |
    | The routing configuration of the admin page, including the path prefix,
    | the controller namespace, and the default middleware. If you want to
    | access through the root path, just set the prefix to empty string.
    |
    */
    'route' => [
        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),
        'namespace' => 'App\\Admin\\Controllers',
        'middleware' => ['web', 'admin'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Client install directory
    |--------------------------------------------------------------------------
    |
    | The installation directory of the controller and routing configuration
    | files of the administration page. The default is `app/Admin`, which must
    | be set before running `artisan sso::install` to take effect.
    |
    */
    'directory' => app_path('Admin'),

  
    /*
    |--------------------------------------------------------------------------
    | Access via `https`
    |--------------------------------------------------------------------------
    |
    | If your page is going to be accessed via https, set it to `true`.
    |
    */
    'https' => env('ADMIN_HTTPS', false),

    /*
    |--------------------------------------------------------------------------
    | Open-admin auth setting
    |--------------------------------------------------------------------------
    |
    | Authentication settings for all admin pages. Include an authentication
    | guard and a user provider setting of authentication driver.
    |
    | You can specify a controller for `login` `logout` and other auth routes.
    |
    */
    'auth' => [

        'controller' => App\Admin\Controllers\AuthController::class,

        'guard' => 'admin',

        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => NasuhTurkmen\Admin\Auth\Database\Administrator::class,
            ],
        ],

        // Add "remember me" to login form
        'remember' => true,

        // Redirect to the specified URI when user is not authorized.
        'redirect_to' => 'auth/login',

        // Protect agaist brute force attacks
        'throttle_logins'   => true,
        'throttle_attempts' => 5,
        'throttle_timeout'  => 900, // in seconds

        // The URIs that should be excluded from authorization.
        'excepts' => [
            'auth/login',
            'auth/logout',
        ],
        
    ],

    /*
    |--------------------------------------------------------------------------
    | SSO Endpoints
    |--------------------------------------------------------------------------
    |
    | Endpoints for Single Sign-On (SSO) login and token validation.
    |
    */
    'sso' => [
        'login_url' => env('SSO_LOGIN_URL', 'https://login.nasuhturkmen.com'),
        'token_validation_url' => env('SSO_TOKEN_VALIDATION_URL', 'https://login.nasuhturkmen.com/validate-token'),
    ],

    /*
    |--------------------------------------------------------------------------
    | SSO Client Credentials
    |--------------------------------------------------------------------------
    |
    | Client ID and Secret for authenticating with the SSO server.
    |
    */
    'sso_client' => [
        'id' => env('SSO_CLIENT_ID', 'your-client-id'),
        'locale_id' => env('SSO_CLIENT_LOCALE_ID', 'tr_TR'),
        'route_url' => env('SSO_CLIENT_REDIRECT_URL', 'http://127.0.0.1:8000/auth/login')
    ],

    /*
    |--------------------------------------------------------------------------
    | SSO Connection Settings
    |--------------------------------------------------------------------------
    |
    | Timeout and retry settings for SSO server communication.
    |
    */
    'sso_connection' => [
        'timeout' => env('SSO_CONNECTION_TIMEOUT', 5), // seconds
        'retry' => env('SSO_RETRY_COUNT', 3),
    ],

    /*
    |--------------------------------------------------------------------------
    | Open-admin database settings
    |--------------------------------------------------------------------------
    |
    | Here are database settings for open-admin builtin model & tables.
    |
    */
    'database' => [

        // Database connection for following tables.
        'connection' => '',

        // User tables and model.
        'users_table' => 'admin_users',
        'users_model' => NasuhTurkmen\Admin\Auth\Database\Administrator::class,

        // Pivot table for table above.
        'operation_log_table'    => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table'       => 'admin_role_users',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table'        => 'admin_role_menu',
    ],

    /*
    |--------------------------------------------------------------------------
    | User operation log setting
    |--------------------------------------------------------------------------
    |
    | By setting this option to open or close operation log in open-admin.
    |
    */
    'operation_log' => [

        'enable' => true,

        /*
         * Only logging allowed methods in the list
         */
        'allowed_methods' => ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'],

        /*
         * Routes that will not log to database.
         *
         * All method to path like: admin/auth/logs
         * or specific method to path like: get:admin/auth/logs.
         */
        'except' => [
            env('ADMIN_ROUTE_PREFIX', 'admin').'/auth/logs*',
        ],

        /*
         * Replace input fields that should not be logged
         */
        'filter_input' => [
            'token'             => '*****-filtered-out-*****',
            'password'          => '*****-filtered-out-*****',
            'password_remember' => '*****-filtered-out-*****',
        ],
    ],
];
