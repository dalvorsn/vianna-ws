<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => true, // Should be set to false in production
            'logger'              => [
                'name'  => 'slim-app',
                'path'  => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                'level' => Logger::DEBUG,
            ],

            // Configurações para conexão com banco de dados
            "db"                  => [
                "host"   => $_ENV['WS_DB_HOST'] ?? "localhost",
                "dbname" => $_ENV['WS_DB_NAME'] ?? "ws",
                "user"   => $_ENV['WS_DB_USER'] ?? "root",
                "pass"   => $_ENV['WS_DB_PASS'] ?? "123456",
            ],
        ],
    ]);
};
