<?php
/**
 * Returns a database configuration
 * and other dependencies.
 * Please, make sure to remove the example extension!
 * The 'database' key provide a fine configuration driver to doctrine.
 * token-secret key is the hash key to JWT auth.
 */
return [
    'database' => [
        'dbname' => 'mytodo',
        'user' => 'root',
        'password' => 'ur_password',
        'host' => 'localhost',
        'driver' => 'pdo_mysql'
    ]
    //"token-secret"=>"your-jwt-secret"
];
