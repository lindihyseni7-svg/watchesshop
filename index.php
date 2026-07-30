<?php
declare(strict_types=1);

// Front controller: resolves exact and parameterized web/API/admin routes.
require __DIR__ . '/src/bootstrap.php';

$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
$path = request_path();
$routes = array_merge(
    require ROOT_PATH . '/routes/web.php',
    require ROOT_PATH . '/routes/api.php',
    require ROOT_PATH . '/routes/admin.php'
);
$key = $method . ' ' . $path;

if (isset($routes[$key])) {
    $routes[$key]();
    exit;
}

if ($method === 'GET' && preg_match('#^/product/([a-z0-9-]+)$#', $path, $matches)) {
    (new App\Controllers\StoreController())->product($matches[1]);
    exit;
}

if (preg_match('#^/admin/([a-z]+)/(\d+)/(edit|delete)$#', $path, $matches)) {
    $admin = new App\Controllers\AdminController();
    $entity = $matches[1];
    $id = (int) $matches[2];
    $action = $matches[3];
    if ($admin->hasEntity($entity) && $action === 'edit' && $method === 'GET') {
        $admin->form($entity, $id);
        exit;
    }
    if ($admin->hasEntity($entity) && $action === 'edit' && $method === 'POST') {
        $admin->save($entity, $id);
        exit;
    }
    if ($admin->hasEntity($entity) && $action === 'delete' && $method === 'POST') {
        $admin->delete($entity, $id);
        exit;
    }
}

http_response_code(404);
render('404', [
    'title' => 'Faqja nuk u gjet',
    'cartCount' => (new App\Services\CartService())->count(),
    'favoriteIds' => (new App\Services\FavoriteService())->ids(),
    'favoriteCount' => (new App\Services\FavoriteService())->count(),
]);
