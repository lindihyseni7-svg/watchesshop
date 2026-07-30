<?php
declare(strict_types=1);

// Public storefront and authentication route definitions.
use App\Controllers\AuthController;
use App\Controllers\StoreController;

$store = new StoreController();
$auth = new AuthController();

return [
    'GET /' => fn () => $store->home(),
    'GET /home' => fn () => $store->home(),
    'GET /shop' => fn () => $store->shop(),
    'GET /favorites' => fn () => $store->favorites(),
    'GET /cart' => fn () => $store->cart(),
    'GET /about' => fn () => $store->static('about', 'Rreth nesh | Watches Prishtina'),
    'GET /contact' => fn () => $store->static('contact', 'Kontakt | Watches Prishtina'),
    'GET /faq' => fn () => $store->static('faq', 'Pyetje te shpeshta | Watches Prishtina'),
    'GET /login' => fn () => $auth->loginForm(),
    'POST /login' => fn () => $auth->login(),
    'GET /register' => fn () => $auth->registerForm(),
    'POST /register' => fn () => $auth->register(),
    'POST /logout' => fn () => $auth->logout(),
];
