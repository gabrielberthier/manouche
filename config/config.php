<?php

return [
    'database' => [
        'dbname' => 'mytodo',
        'user' => 'root',
        'password' => 'mithrandir2050',
        'connection' => 'mysql:host=127.0.0.1',
        'driver'   => 'pdo_mysql',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
