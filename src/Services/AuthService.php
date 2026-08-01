<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;

// Handles password verification, legacy password upgrades and secure session identity.
final class AuthService
{
    public function __construct(private readonly UserRepository $users = new UserRepository())
    {
    }

    public function attempt(string $email, string $password): bool
    {
        $user = $this->users->findByEmail(strtolower(trim($email)));
        if (!$user) {
            return false;
        }

        $stored = (string) $user['fjalekalimi'];
        $isHash = password_get_info($stored)['algo'] !== null;
        $valid = $isHash
            ? password_verify($password, $stored)
            : hash_equals($stored, $password);

        if (!$valid) {
            return false;
        }

        if (!$isHash || password_needs_rehash($stored, PASSWORD_DEFAULT)) {
            $this->users->upgradePassword((int) $user['perdoruesiid'], $password);
        }

        session_regenerate_id(true);
        $_SESSION['perdoruesi'] = [
            'id' => (int) $user['perdoruesiid'],
            'name' => trim($user['emri'] . ' ' . $user['mbiemri']),
            'email' => $user['email'],
            'role' => $this->normalizeRole($user['role']),
        ];
        $this->users->markLogin((int) $user['perdoruesiid']);
        return true;
    }

    public function register(array $data): array
    {
        $data['email'] = strtolower(trim($data['email'] ?? ''));
        $errors = $this->validate($data);
        if ($this->users->emailExists($data['email'])) {
            $errors['email'] = 'Ky email eshte regjistruar me pare.';
        }
        if ($errors) {
            return $errors;
        }

        $data['role'] = 'Perdorues';
        $this->users->create($data);
        return [];
    }

    public function logout(): void
    {
        unset($_SESSION['perdoruesi']);
        session_regenerate_id(true);
    }

    private function validate(array $data): array
    {
        $errors = [];
        if (strlen(trim($data['first_name'] ?? '')) < 2) $errors['first_name'] = 'Shkruaj emrin.';
        if (strlen(trim($data['last_name'] ?? '')) < 2) $errors['last_name'] = 'Shkruaj mbiemrin.';
        if (!filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Email nuk eshte valide.';
        if (strlen($data['password'] ?? '') < 8) $errors['password'] = 'Fjalekalimi duhet te kete se paku 8 karaktere.';
        if (($data['password'] ?? '') !== ($data['password_confirmation'] ?? '')) {
            $errors['password_confirmation'] = 'Fjalekalimet nuk perputhen.';
        }
        return $errors;
    }

    private function normalizeRole(string $role): string
    {
        $normalized = strtolower(trim($role));
        if (in_array($normalized, ['admin', 'administrator'], true)) {
            return 'Administrator';
        }
        if (in_array($normalized, ['demoadmin', 'demo_admin', 'demo-admin', 'demo viewer', 'demo_viewer'], true)) {
            return 'DemoAdmin';
        }
        return 'Perdorues';
    }
}
