<?php
declare(strict_types=1);

require __DIR__ . '/src/bootstrap.php';

$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
$path = request_path();
$routes = array_merge(require ROOT_PATH . '/routes/web.php', require ROOT_PATH . '/routes/api.php');
$key = $method . ' ' . $path;

if (isset($routes[$key])) {
    $routes[$key]();
    exit;
}

if ($method === 'GET' && preg_match('#^/product/([a-z0-9-]+)$#', $path, $matches)) {
    (new App\Controllers\StoreController())->product($matches[1]);
    exit;
}

http_response_code(404);
render('404', [
    'title' => 'Faqja nuk u gjet',
    'cartCount' => (new App\Services\CartService())->count(),
    'favoriteIds' => (new App\Services\FavoriteService())->ids(),
    'favoriteCount' => (new App\Services\FavoriteService())->count(),
]);
