<?php
declare(strict_types=1);

namespace App\Core;

use mysqli;
use RuntimeException;

// Provides one utf8mb4 MySQL connection for the request lifecycle.
final class Database
{
    private static ?mysqli $connection = null;

    public static function connection(): mysqli
    {
        if (self::$connection instanceof mysqli) {
            return self::$connection;
        }

        $config = self::config();

        self::$connection = new mysqli(
            $config['host'],
            $config['user'],
            $config['password'],
            $config['database'],
            $config['port']
        );

        if (self::$connection->connect_errno) {
            throw new RuntimeException('Lidhja me databazen deshtoi.');
        }

        self::$connection->set_charset('utf8mb4');
        return self::$connection;
    }

    private static function config(): array
    {
        $config = [
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'database' => 'watches',
            'port' => 3306,
        ];

        // Shared hosts like InfinityFree usually cannot set env vars, so this
        // ignored file carries the real production credentials outside Git.
        $file = ROOT_PATH . '/config/database.php';
        if (is_file($file)) {
            $config = array_merge($config, require $file);
        }

        $config['host'] = getenv('DB_HOST') ?: $config['host'];
        $config['user'] = getenv('DB_USER') ?: $config['user'];
        $config['password'] = getenv('DB_PASS') ?: $config['password'];
        $config['database'] = getenv('DB_NAME') ?: $config['database'];
        $config['port'] = (int) (getenv('DB_PORT') ?: $config['port']);

        return $config;
    }
}
