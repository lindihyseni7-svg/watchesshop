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
echo "Session status: " . (session_status() === PHP_SESSION_ACTIVE ? 'active' : 'inactive') . "\n";
echo "About image pikat.jpg: " . (is_file(ROOT_PATH . '/img/pikat.jpg') ? 'found' : 'missing') . "\n";
echo "About image section2.jpg: " . (is_file(ROOT_PATH . '/img/section2.jpg') ? 'found' : 'missing') . "\n";

try {
    $db = App\Core\Database::connection();
    echo "Database connection: ok\n";
    echo "Products table count: " . $db->query('SELECT COUNT(*) FROM orat')->fetch_row()[0] . "\n";
    echo "Users table count: " . $db->query('SELECT COUNT(*) FROM perdoruesit')->fetch_row()[0] . "\n";
    echo "Contact table count: " . $db->query('SELECT COUNT(*) FROM contact_messages')->fetch_row()[0] . "\n";

    $stmt = $db->prepare('SELECT email, role, fjalekalimi FROM perdoruesit WHERE email = ? LIMIT 1');
    $email = 'admin@watchesshop.test';
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();
    echo "Demo admin exists: " . ($admin ? 'yes' : 'no') . "\n";
    if ($admin) {
        echo "Demo admin role: " . $admin['role'] . "\n";
        echo "Demo admin password valid: " . (password_verify('admin12345', (string) $admin['fjalekalimi']) ? 'yes' : 'no') . "\n";
    }

    $writeToken = 'deploy-check-' . bin2hex(random_bytes(4));
    $writeStmt = $db->prepare(
        'INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)'
    );
    $writeName = 'Deploy Check';
    $writeEmail = 'deploy-check@example.com';
    $writeSubject = 'Write test';
    $writeMessage = 'Temporary write test ' . $writeToken;
    $writeStmt->bind_param('ssss', $writeName, $writeEmail, $writeSubject, $writeMessage);
    $writeStmt->execute();
    $writeId = (int) $db->insert_id;
    $deleteStmt = $db->prepare('DELETE FROM contact_messages WHERE id = ?');
    $deleteStmt->bind_param('i', $writeId);
    $deleteStmt->execute();
    echo "Database write test: ok\n";

    echo "Status: ready\n";
} catch (Throwable $exception) {
    http_response_code(500);
    echo "Database/app error: " . $exception->getMessage() . "\n";
}
