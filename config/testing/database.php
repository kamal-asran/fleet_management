<?php

return [
    'default' => 'sqlite_testing',
    'connections' => [
        'sqlite_testing' => [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            'url' => null,
        ],
    ],
];