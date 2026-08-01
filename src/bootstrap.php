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

function safe_image(?string $path, string $fallback = 'public/assets/images/hero-watches.png'): string
{
    $candidate = trim((string) $path);
    if ($candidate !== '' && is_file(ROOT_PATH . '/' . ltrim($candidate, '/'))) {
        return url($candidate);
    }
    return url($fallback);
}

function product_image(?string $path): string
{
    $candidate = trim((string) $path);
    $imageMap = [
        'img/o10.jpg' => 'img/smart-watch-card.jpg',
        'img/o11.jpg' => 'img/philipp-plein-red-card.jpg',
        'img/o12.jpg' => 'img/bulova-chronograph-card.jpg',
        'img/o13.jpg' => 'img/bulova-rectangular-card.jpg',
        'img/o14.jpg' => 'img/seiko-black-card.webp',
        'img/o15.jpg' => 'img/rolex-sea-dweller-card.webp',
        'img/o16.jpg' => 'img/gucci-blue-card.jpg',
        'img/o17.jpg' => 'img/alpina-pink-card.webp',
        'img/o18.jpg' => 'img/smart-watch-card.jpg',
        'img/o19.jpg' => 'img/rolex-sea-dweller-card.webp',
        'img/o20.jpg' => 'img/seiko-black-card.webp',
        'img/o21.jpg' => 'img/emporio-armani-diver-card.jpg',
        'img/o22.jpg' => 'img/o6.jpg',
        'img/o23.jpg' => 'img/gucci-blue-card.jpg',
        'img/o24.jpg' => 'img/bulova-rectangular-card.jpg',
        'img/o25.jpg' => 'img/diesel-blue-card.webp',
        'img/o26.jpg' => 'img/diesel-red-card.jpg',
        'img/o27.jpg' => 'img/o1.jpg',
        'img/o28.jpg' => 'img/philipp-plein-black-card.webp',
        'img/o29.jpg' => 'img/philipp-plein-black-card.webp',
        'img/o30.jpg' => 'img/seiko-black-card.webp',
        'img/o31.jpg' => 'img/philipp-plein-red-card.jpg',
        'img/o32.jpg' => 'img/smart-watch-card.jpg',
        'img/o33.jpg' => 'img/diesel-blue-card.webp',
        'img/o35.jpg' => 'img/bulova-chronograph-card.jpg',
        'img/o36.jpg' => 'img/alpina-pink-card.webp',
        'img/o37.jpg' => 'img/emporio-armani-diver-card.jpg',
        'img/o38.jpg' => 'img/o1.jpg',
        'img/o39.jpg' => 'img/gucci-blue-card.jpg',
        'img/ora2.jpg' => 'img/seiko-black-card.webp',
        'img/ora4.jpg' => 'img/showcase-section.jpg',
        'img/a6.jpg' => 'img/bulova-rectangular-card.jpg',
    ];

    return safe_image($imageMap[$candidate] ?? ($candidate ?: 'img/o0.jpg'), 'img/o0.jpg');
}

function product_copy(array $product): array
{
    $curated = [
        'rolex-submariner-116610' => [
            'description' => 'Diver profesional me bezel nje-drejtimor, dial me kontrast te larte dhe konstruksion celiku per perdorim serioz ne uje.',
            'story' => 'Submariner u prezantua si ore instrumentale per zhytje dhe u kthye ne nje nga siluetat me te njohura ne historine e orave. Referenca 116610 ruan proporcionin klasik dhe e kombinon me bezel qeramike dhe mekanizem automatik.',
        ],
        'casio-edifice-efr-556' => [
            'description' => 'Kronograf quartz me dial shumeshtresor, kase celiku dhe tregues te medhenj per lexim te shpejte gjate dites.',
            'story' => 'Linja Edifice sjell gjuhen e motorsportit ne nje ore te perditshem. EFR-556 fokusohet te funksioni i kronografit, qendrueshmeria dhe pamja teknike pa kerkuar mirembajtje mekanike.',
        ],
        'rolex-daytona-116500' => [
            'description' => 'Kronograf automatik me shkalle tachymeter, totalizues te balancuar dhe identitet te lidhur ngushte me motorsportin.',
            'story' => 'Cosmograph Daytona u projektua per matjen e kohes dhe shpejtesise ne piste. Referenca 116500 e sjell kete trashegimi me bezel qeramike dhe nje nga konfigurimet me te njohura te dialit modern.',
        ],
        'casio-g-shock-ga-2100' => [
            'description' => 'Ore ana-digjitale rezistente ndaj goditjeve, me profil te holle, kase te lehte dhe rezistence 200 metra ne uje.',
            'story' => 'GA-2100 bashkon strukturen Carbon Core Guard me nje forme oktagonale moderne. Rezultati eshte nje G-Shock i lehte dhe praktik qe ruan standardin e fortesise se linjes.',
        ],
        'rolex-datejust-126200' => [
            'description' => 'Ore automatike klasike me dritare date, proporcion te balancuar dhe kase celiku per perdorim nga dita ne mbremje.',
            'story' => 'Datejust krijoi nje formule qe vazhdon prej dekadash: date e lexueshme, dizajn i matur dhe mekanizem automatik. Referenca 126200 e mban kete identitet ne nje interpretim modern dhe te gjithanshem.',
        ],
        'casio-vintage-a168wa' => [
            'description' => 'Ore digjitale retro me ekran te qarte, alarm, kronometer dhe bracelet metalik te lehte per perdorim te perditshem.',
            'story' => 'A168WA eshte pjese e gjuhes vizuale qe e beri Casio-n ikone te dizajnit digjital. Formati kompakt dhe funksionet e thjeshta e mbajne relevant edhe sot.',
        ],
    ];

    $fallbackDescription = trim((string) ($product['pershkrimi'] ?? ''));
    $fallbackStory = trim((string) ($product['historia'] ?? ''));
    $specific = $curated[$product['slug'] ?? ''] ?? [];

    return [
        'description' => $specific['description'] ?? ($fallbackDescription !== '' ? $fallbackDescription : sprintf('%s %s me specifika te zgjedhura per perdorim te perditshem.', $product['brand'] ?? 'Ore', $product['modeli'] ?? '')),
        'story' => $specific['story'] ?? ($fallbackStory !== '' ? $fallbackStory : sprintf('%s %s perfaqeson gjuhen e dizajnit dhe inxhinierise se markes.', $product['brand'] ?? 'Ky model', $product['modeli'] ?? '')),
    ];
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

function is_demo_admin(): bool
{
    return ($_SESSION['perdoruesi']['role'] ?? '') === 'DemoAdmin';
}

function can_access_admin(): bool
{
    return is_admin() || is_demo_admin();
}

function can_mutate_admin(): bool
{
    return is_admin();
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
        redirect(can_access_admin() ? 'admin' : '');
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
    if (!can_access_admin()) {
        flash('error', 'Nuk ke leje per panelin e administrimit.');
        redirect('');
    }
}

function require_admin_mutation(): void
{
    require_admin();
    if (!can_mutate_admin()) {
        flash('error', 'Demo admin eshte vetem per shikim. Ky veprim nuk lejohet sepse do te ndryshonte te dhenat reale te projektit; vetem administratori mund te beje ndryshime.');
        redirect('admin');
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
