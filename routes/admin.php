<?php
declare(strict_types=1);

use App\Controllers\AdminController;

// Exact admin routes; record-specific routes are dispatched by the front controller.
$admin = new AdminController();

return [
    'GET /admin' => fn () => $admin->dashboard(),
    'GET /admin/products' => fn () => $admin->index('products'),
    'GET /admin/users' => fn () => $admin->index('users'),
    'GET /admin/brands' => fn () => $admin->index('brands'),
    'GET /admin/categories' => fn () => $admin->index('categories'),
    'GET /admin/offers' => fn () => $admin->index('offers'),
    'GET /admin/products/create' => fn () => $admin->form('products'),
    'GET /admin/users/create' => fn () => $admin->form('users'),
    'GET /admin/brands/create' => fn () => $admin->form('brands'),
    'GET /admin/categories/create' => fn () => $admin->form('categories'),
    'GET /admin/offers/create' => fn () => $admin->form('offers'),
    'POST /admin/products/create' => fn () => $admin->save('products'),
    'POST /admin/users/create' => fn () => $admin->save('users'),
    'POST /admin/brands/create' => fn () => $admin->save('brands'),
    'POST /admin/categories/create' => fn () => $admin->save('categories'),
    'POST /admin/offers/create' => fn () => $admin->save('offers'),
];

