<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\ProductRepository;

final class CartService
{
    public function add(int $productId, int $quantity = 1): void
    {
        $quantity = max(1, min(10, $quantity));
        $_SESSION['cart'][$productId] = min(10, ($_SESSION['cart'][$productId] ?? 0) + $quantity);
    }

    public function update(int $productId, int $quantity): void
    {
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$productId]);
            return;
        }
        $_SESSION['cart'][$productId] = min(10, $quantity);
    }

    public function remove(int $productId): void
    {
        unset($_SESSION['cart'][$productId]);
    }

    public function count(): int
    {
        return array_sum($_SESSION['cart'] ?? []);
    }

    public function details(ProductRepository $products): array
    {
        $cart = $_SESSION['cart'] ?? [];
        $records = $products->findMany(array_keys($cart));
        $items = [];
        $total = 0.0;

        foreach ($cart as $id => $quantity) {
            if (!isset($records[$id])) {
                continue;
            }
            $product = $records[$id];
            $price = (float) $product['cmimi'] * (1 - ((float) $product['discount_percent'] / 100));
            $subtotal = $price * $quantity;
            $total += $subtotal;
            $items[] = compact('product', 'quantity', 'price', 'subtotal');
        }

        return compact('items', 'total');
    }
}

