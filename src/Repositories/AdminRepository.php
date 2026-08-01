<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database;

// Generic prepared-statement CRUD used only with controller-owned table configuration.
final class AdminRepository
{
    public function all(string $table, string $primaryKey): array
    {
        $result = Database::connection()->query("SELECT * FROM {$table} ORDER BY {$primaryKey} DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find(string $table, string $primaryKey, int $id): ?array
    {
        $stmt = Database::connection()->prepare(
            "SELECT * FROM {$table} WHERE {$primaryKey} = ? LIMIT 1"
        );
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    public function create(string $table, array $data): int
    {
        $columns = array_keys($data);
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));
        $stmt = Database::connection()->prepare(
            "INSERT INTO {$table} (" . implode(', ', $columns) . ") VALUES ({$placeholders})"
        );
        $values = array_values($data);
        $types = $this->parameterTypes($values);
        $stmt->bind_param($types, ...$values);
        $stmt->execute();
        return (int) Database::connection()->insert_id;
    }

    public function update(string $table, string $primaryKey, int $id, array $data): void
    {
        $assignments = implode(', ', array_map(fn (string $column) => "{$column} = ?", array_keys($data)));
        $stmt = Database::connection()->prepare(
            "UPDATE {$table} SET {$assignments} WHERE {$primaryKey} = ?"
        );
        $values = [...array_values($data), $id];
        $types = $this->parameterTypes($values);
        $stmt->bind_param($types, ...$values);
        $stmt->execute();
    }

    public function delete(string $table, string $primaryKey, int $id): void
    {
        $stmt = Database::connection()->prepare("DELETE FROM {$table} WHERE {$primaryKey} = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public function counts(): array
    {
        $tables = [
            'products' => 'orat',
            'users' => 'perdoruesit',
            'brands' => 'brendet',
            'categories' => 'kategorite',
            'offers' => 'ofertat',
            'messages' => 'contact_messages',
            'newsletter' => 'newsletter_subscribers',
            'watch_sale_requests' => 'watch_sale_requests',
            'orders' => 'orders',
            'order_items' => 'order_items',
        ];
        $counts = [];
        foreach ($tables as $key => $table) {
            $counts[$key] = (int) Database::connection()->query("SELECT COUNT(*) FROM {$table}")->fetch_row()[0];
        }
        return $counts;
    }

    public function selectOptions(string $table, string $idColumn, string $labelColumn): array
    {
        $result = Database::connection()->query(
            "SELECT {$idColumn} AS value, {$labelColumn} AS label FROM {$table} ORDER BY {$labelColumn}"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    private function parameterTypes(array $values): string
    {
        $types = '';
        foreach ($values as $value) {
            $types .= is_int($value) ? 'i' : (is_float($value) ? 'd' : 's');
        }
        return $types;
    }
}
