<?php
declare(strict_types=1);

namespace App\Repositories;

// Persists contact requests and newsletter subscriptions.
use App\Core\Database;
use mysqli_sql_exception;

final class CommunicationRepository
{
    public function saveMessage(string $name, string $email, string $subject, string $message): void
    {
        $stmt = Database::connection()->prepare(
            'INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)'
        );
        $stmt->bind_param('ssss', $name, $email, $subject, $message);
        $stmt->execute();
    }

    public function subscribe(string $email): void
    {
        $stmt = Database::connection()->prepare(
            'INSERT INTO newsletter_subscribers (email, is_active) VALUES (?, 1)
             ON DUPLICATE KEY UPDATE is_active = 1'
        );
        $stmt->bind_param('s', $email);
        $stmt->execute();
    }
}
