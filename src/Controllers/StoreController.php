<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\ProductRepository;
use App\Services\CartService;
use App\Services\FavoriteService;

final class StoreController
{
    public function __construct(
        private readonly ProductRepository $products = new ProductRepository(),
        private readonly CartService $cart = new CartService(),
        private readonly FavoriteService $favorites = new FavoriteService()
    ) {
    }

    private function shared(array $data = []): array
    {
        return array_merge([
            'cartCount' => $this->cart->count(),
            'favoriteIds' => $this->favorites->ids(),
            'favoriteCount' => $this->favorites->count(),
        ], $data);
    }

    public function home(): void
    {
        render('home', $this->shared([
            'title' => 'Watches Prishtina | Ore premium',
            'featured' => $this->products->featured(8),
            'newest' => $this->products->newest(8),
            'brands' => $this->products->brands(),
            'stats' => $this->products->stats(),
        ]));
    }

    public function shop(): void
    {
        $filters = [
            'search' => $_GET['search'] ?? '',
            'brand' => $_GET['brand'] ?? '',
            'min' => $_GET['min'] ?? '',
            'max' => $_GET['max'] ?? '',
            'discount' => $_GET['discount'] ?? '',
            'in_stock' => $_GET['in_stock'] ?? '',
            'sort' => $_GET['sort'] ?? 'newest',
            'page' => $_GET['page'] ?? 1,
        ];

        render('shop', $this->shared([
            'title' => 'Katalogu | Watches Prishtina',
            'catalog' => $this->products->catalog($filters),
            'brands' => $this->products->brands(),
            'filters' => $filters,
        ]));
    }

    public function product(string $slug): void
    {
        $product = $this->products->find($slug);
        if (!$product) {
            http_response_code(404);
            render('404', $this->shared(['title' => 'Produkti nuk u gjet']));
            return;
        }

        render('product', $this->shared([
            'title' => $product['emri'] . ' | Watches Prishtina',
            'product' => $product,
            'related' => $this->products->related($product),
        ]));
    }

    public function favorites(): void
    {
        $records = $this->products->findMany($this->favorites->ids());
        render('favorites', $this->shared([
            'title' => 'Lista e deshirave | Watches Prishtina',
            'products' => array_values($records),
        ]));
    }

    public function cart(): void
    {
        render('cart', $this->shared([
            'title' => 'Shporta | Watches Prishtina',
            'cart' => $this->cart->details($this->products),
        ]));
    }

    public function static(string $view, string $title): void
    {
        render($view, $this->shared(['title' => $title]));
    }
}

