<?php
declare(strict_types=1);

namespace App\Services;

// Manages the current visitor's session-backed favorite product identifiers.
final class FavoriteService
{
    public function toggle(int $productId): bool
    {
        $favorites = $_SESSION['favorites'] ?? [];
        if (in_array($productId, $favorites, true)) {
            $_SESSION['favorites'] = array_values(array_diff($favorites, [$productId]));
            return false;
        }

        $favorites[] = $productId;
        $_SESSION['favorites'] = array_values(array_unique($favorites));
        return true;
    }

    public function ids(): array
    {
        return array_map('intval', $_SESSION['favorites'] ?? []);
    }

    public function has(int $productId): bool
    {
        return in_array($productId, $this->ids(), true);
    }

    public function count(): int
    {
        return count($this->ids());
    }
}
