<?php
declare(strict_types=1);

// Temporary shared-hosting diagnostic: checks PHP, config and MySQL without
// printing database passwords or other secrets.
require __DIR__ . '/src/bootstrap.php';

header('Content-Type: text/plain; charset=utf-8');

echo "Watches Prishtina deploy check\n";
echo "PHP: " . PHP_VERSION . "\n";
echo "Project root: ok\n";
echo "Config file: " . (is_file(ROOT_PATH . '/config/database.php') ? 'found' : 'missing') . "\n";

try {
    $db = App\Core\Database::connection();
    echo "Database connection: ok\n";
    echo "Products table count: " . $db->query('SELECT COUNT(*) FROM orat')->fetch_row()[0] . "\n";
    echo "Users table count: " . $db->query('SELECT COUNT(*) FROM perdoruesit')->fetch_row()[0] . "\n";
    echo "Status: ready\n";
} catch (Throwable $exception) {
    http_response_code(500);
    echo "Database/app error: " . $exception->getMessage() . "\n";
}
