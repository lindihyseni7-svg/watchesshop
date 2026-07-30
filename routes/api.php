<?php
declare(strict_types=1);

// JSON endpoints used by cart, favorites, contact and newsletter interactions.
use App\Repositories\ProductRepository;
use App\Repositories\CommunicationRepository;
use App\Services\CartService;
use App\Services\FavoriteService;

return [
    'POST /api/cart/add' => function (): never {
        verify_csrf();
        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $productId = (int) ($input['product_id'] ?? 0);
        $quantity = (int) ($input['quantity'] ?? 1);
        $product = (new ProductRepository())->find($productId);
        if (!$product) {
            json_response(['message' => 'Produkti nuk u gjet.'], 404);
        }
        $cart = new CartService();
        $cart->add($productId, $quantity);
        $details = $cart->details(new ProductRepository());
        json_response([
            'message' => $product['emri'] . ' u shtua ne shporte.',
            'cart_count' => $cart->count(),
            'cart_total' => money($details['total']),
        ]);
    },
    'POST /api/cart/update' => function (): never {
        verify_csrf();
        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $cart = new CartService();
        $cart->update((int) ($input['product_id'] ?? 0), (int) ($input['quantity'] ?? 0));
        $details = $cart->details(new ProductRepository());
        $lineTotal = null;
        foreach ($details['items'] as $item) {
            if ((int) $item['product']['id'] === (int) ($input['product_id'] ?? 0)) {
                $lineTotal = money($item['subtotal']);
                break;
            }
        }
        json_response([
            'message' => 'Shporta u perditesua.',
            'cart_count' => $cart->count(),
            'cart_total' => money($details['total']),
            'line_total' => $lineTotal,
        ]);
    },
    'POST /api/favorites/toggle' => function (): never {
        verify_csrf();
        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $productId = (int) ($input['product_id'] ?? 0);
        if (!(new ProductRepository())->find($productId)) {
            json_response(['message' => 'Produkti nuk u gjet.'], 404);
        }
        $favorites = new FavoriteService();
        $active = $favorites->toggle($productId);
        json_response([
            'message' => $active ? 'U shtua ne listen e deshirave.' : 'U hoq nga lista e deshirave.',
            'active' => $active,
            'favorites_count' => $favorites->count(),
        ]);
    },
    'POST /api/contact' => function (): never {
        verify_csrf();
        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $name = trim((string) ($input['name'] ?? ''));
        $email = filter_var($input['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $subject = trim((string) ($input['subject'] ?? ''));
        $message = trim((string) ($input['message'] ?? ''));
        if ($name === '' || !$email || $subject === '' || strlen($message) < 10) {
            json_response(['message' => 'Ploteso te gjitha fushat me te dhena valide.'], 422);
        }
        (new CommunicationRepository())->saveMessage($name, $email, $subject, $message);
        json_response(['message' => 'Mesazhi u dergua. Do te kontaktojme se shpejti.']);
    },
    'POST /api/newsletter' => function (): never {
        verify_csrf();
        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $email = filter_var($input['email'] ?? '', FILTER_VALIDATE_EMAIL);
        if (!$email) {
            json_response(['message' => 'Shkruaj nje email valide.'], 422);
        }
        (new CommunicationRepository())->subscribe($email);
        json_response(['message' => 'U regjistrove per lajmet tona.']);
    },
];
