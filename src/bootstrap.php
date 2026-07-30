<?php
declare(strict_types=1);

// Application bootstrap: session, autoloading and shared HTTP/view helpers.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

define('ROOT_PATH', dirname(__DIR__));
define('VIEW_PATH', ROOT_PATH . '/src/Views');

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    $file = ROOT_PATH . '/src/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

function app_base(): string
{
    $directory = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    return $directory === '/' ? '' : rtrim($directory, '/');
}

function url(string $path = ''): string
{
    return app_base() . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
    return url('public/assets/' . ltrim($path, '/'));
}

function product_image(?string $path): string
{
    return url($path ?: 'img/o0.jpg');
}

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function money(mixed $value): string
{
    return number_format((float) $value, 2);
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(24));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    $token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? $_POST['_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'] ?? '', (string) $token)) {
        json_response(['message' => 'Sesioni ka skaduar. Rifresko faqen.'], 419);
    }
}

function json_response(array $data, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

function render(string $view, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require VIEW_PATH . '/layouts/header.php';
    require VIEW_PATH . '/pages/' . $view . '.php';
    require VIEW_PATH . '/layouts/footer.php';
}

function request_path(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $base = app_base();
    if ($base !== '' && str_starts_with($path, $base)) {
        $path = substr($path, strlen($base));
    }
    return '/' . trim($path, '/');
}

function is_admin(): bool
{
    return ($_SESSION['perdoruesi']['role'] ?? '') === 'Administrator';
}

function is_authenticated(): bool
{
    return !empty($_SESSION['perdoruesi']['id']);
}

function current_user(): ?array
{
    return $_SESSION['perdoruesi'] ?? null;
}

function redirect(string $path): never
{
    header('Location: ' . url($path));
    exit;
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'] = compact('type', 'message');
}

function pull_flash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

function require_guest(): void
{
    if (is_authenticated()) {
        redirect(is_admin() ? 'admin' : '');
    }
}

function require_auth(): void
{
    if (!is_authenticated()) {
        flash('error', 'Duhet te kyçesh per te vazhduar.');
        redirect('login');
    }
}

function require_admin(): void
{
    require_auth();
    if (!is_admin()) {
        flash('error', 'Nuk ke leje per panelin e administrimit.');
        redirect('');
    }
}

function verify_form_csrf(): void
{
    $token = $_POST['_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'] ?? '', (string) $token)) {
        http_response_code(419);
        exit('Sesioni ka skaduar. Rifresko faqen dhe provo perseri.');
    }
}

function slugify(string $value): string
{
    $value = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value) ?: $value;
    $value = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $value), '-'));
    return $value !== '' ? $value : 'product-' . time();
}
