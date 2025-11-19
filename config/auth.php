<?php

return [

    'defaults' => [
        'guard' => 'petugas', // DEFAULT JADI PETUGAS
        'passwords' => 'petugas',
    ],

    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'petugas',
        ],

        // Default web guard diarahkan ke PETUGAS
        'petugas' => [
            'driver' => 'session',
            'provider' => 'petugas',
        ],

        'siswa' => [
            'driver' => 'session',
            'provider' => 'siswa',
        ],

        // API kalau kamu butuh
        'api' => [
            'driver' => 'token',
            'provider' => 'petugas',
            'hash' => false,
        ],
    ],

    'providers' => [
        'petugas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Petugas::class,
        ],

        'siswa' => [
            'driver' => 'eloquent',
            'model' => App\Models\Siswa::class,
        ],
    ],

    'passwords' => [
        'petugas' => [
            'provider' => 'petugas',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'siswa' => [
            'provider' => 'siswa',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
