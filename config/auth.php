<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver'  => 'session',
            'provider' => 'users',
        ],

        // Si no usas API por ahora, puedes dejarlo o migrar a Sanctum cuando lo necesites.
        'api' => [
            'driver'  => 'token',
            'provider' => 'users',
            'hash'    => false,
        ],
    ],

    'providers' => [
        // Usa tu modelo App\Models\Usuario que apunta a la tabla 'usuarios'
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Usuario::class,
        ],

        // Alternativa con base de datos (no necesaria si usas Eloquent):
        // 'users' => [
        //     'driver' => 'database',
        //     'table'  => 'usuarios',
        // ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            // Laravel 10+ usa 'password_reset_tokens' por defecto
            'table'    => 'password_reset_tokens',
            'expire'   => 60,   // minutos de validez del token
            'throttle' => 60,   // minutos para rate-limit
        ],
    ],

    'password_timeout' => 10800, // 3 horas
];
