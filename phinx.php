<?php

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

return [
    'paths' => [
        'migrations' => __DIR__.'/database/migrations',
        'seeds' => __DIR__.'/database/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'dev',
        'dev' => [
            'adapter' => getenv('DB_DRIVER'),
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASSWORD'),
            'charset' => getenv('DB_CHARSET'),
            'collation' => getenv('DB_COLLATION'),
            'table_prefix' => '',
        ],
        'test' => [
            'adapter' => getenv('DB_DRIVER'),
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASSWORD'),
            'charset' => getenv('DB_CHARSET'),
            'collation' => getenv('DB_COLLATION'),
            'table_prefix' => 'test_'
        ],
    ],
];
