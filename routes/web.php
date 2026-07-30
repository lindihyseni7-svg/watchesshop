<?php
declare(strict_types=1);

use App\Controllers\StoreController;

$store = new StoreController();

return [
    'GET /' => fn () => $store->home(),
    'GET /home' => fn () => $store->home(),
    'GET /shop' => fn () => $store->shop(),
    'GET /favorites' => fn () => $store->favorites(),
    'GET /cart' => fn () => $store->cart(),
    'GET /about' => fn () => $store->static('about', 'Rreth nesh | Watches Prishtina'),
    'GET /contact' => fn () => $store->static('contact', 'Kontakt | Watches Prishtina'),
    'GET /faq' => fn () => $store->static('faq', 'Pyetje te shpeshta | Watches Prishtina'),
];

