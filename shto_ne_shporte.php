<?php
declare(strict_types=1);

require __DIR__ . '/src/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = (int) ($_POST['product_id'] ?? $_POST['oraid'] ?? 0);
    $quantity = (int) ($_POST['quantity'] ?? $_POST['sasia'] ?? 1);
    if ((new App\Repositories\ProductRepository())->find($productId)) {
        (new App\Services\CartService())->add($productId, $quantity);
    }
}

header('Location: ' . url('cart'));
exit;
