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

        self::$connection = new mysqli(
            getenv('DB_HOST') ?: 'localhost',
            getenv('DB_USER') ?: 'root',
            getenv('DB_PASS') ?: '',
            getenv('DB_NAME') ?: 'watches'
        );

        if (self::$connection->connect_errno) {
            throw new RuntimeException('Lidhja me databazen deshtoi.');
        }

        self::$connection->set_charset('utf8mb4');
        return self::$connection;
    }
}
