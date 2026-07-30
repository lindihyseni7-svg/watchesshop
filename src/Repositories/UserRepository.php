<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database;

// Encapsulates user queries so authentication never depends on legacy SQL helpers.
final class UserRepository
{
    public function findByEmail(string $email): ?array
    {
        $stmt = Database::connection()->prepare('SELECT * FROM perdoruesit WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    public function emailExists(string $email, ?int $exceptId = null): bool
    {
        if ($exceptId) {
            $stmt = Database::connection()->prepare(
                'SELECT 1 FROM perdoruesit WHERE email = ? AND perdoruesiid <> ? LIMIT 1'
            );
            $stmt->bind_param('si', $email, $exceptId);
        } else {
            $stmt = Database::connection()->prepare('SELECT 1 FROM perdoruesit WHERE email = ? LIMIT 1');
            $stmt->bind_param('s', $email);
        }
        $stmt->execute();
        return (bool) $stmt->get_result()->fetch_row();
    }

    public function create(array $data): int
    {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = Database::connection()->prepare(
            'INSERT INTO perdoruesit (emri, mbiemri, email, fjalekalimi, telefoni, nrpersonal, role)
             VALUES (?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->bind_param(
            'sssssss',
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $password,
            $data['phone'],
            $data['personal_number'],
            $data['role']
        );
        $stmt->execute();
        return (int) Database::connection()->insert_id;
    }

    public function upgradePassword(int $id, string $plainPassword): void
    {
        $hash = password_hash($plainPassword, PASSWORD_DEFAULT);
        $stmt = Database::connection()->prepare(
            'UPDATE perdoruesit SET fjalekalimi = ? WHERE perdoruesiid = ?'
        );
        $stmt->bind_param('si', $hash, $id);
        $stmt->execute();
    }

    public function markLogin(int $id): void
    {
        $stmt = Database::connection()->prepare(
            'UPDATE perdoruesit SET last_login_at = CURRENT_TIMESTAMP WHERE perdoruesiid = ?'
        );
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }
}

