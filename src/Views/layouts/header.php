<?php
// Shared storefront/admin document header and role-aware navigation.
$currentPath = request_path();
$title = $title ?? 'Watches Prishtina';
$cartCount = $cartCount ?? 0;
$favoriteCount = $favoriteCount ?? 0;
$flashMessage = pull_flash();
?>
<!doctype html>
<html lang="sq">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Koleksion i kuruar i orave premium, sportive dhe klasike ne Prishtine.">
    <meta name="theme-color" content="#0b0d10">
    <meta name="csrf-token" content="<?= e(csrf_token()); ?>">
    <title><?= e($title); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(asset('css/app.css') . '?v=' . filemtime(ROOT_PATH . '/public/assets/css/app.css')); ?>">
    <script src="https://unpkg.com/lucide@0.468.0/dist/umd/lucide.min.js" defer></script>
    <script src="<?= e(asset('js/app.js') . '?v=' . filemtime(ROOT_PATH . '/public/assets/js/app.js')); ?>" defer></script>
</head>
<body>
<div class="announcement">
    <span>Transport falas mbi $300</span>
    <span>Garanci autenticiteti</span>
    <span>Kthim brenda 14 ditesh</span>
</div>

<header class="store-header">
    <div class="nav-shell">
        <button class="icon-button mobile-menu-button" type="button" data-menu-toggle aria-label="Hap menune">
            <i data-lucide="menu"></i>
        </button>

        <a class="wordmark" href="<?= e(url()); ?>" aria-label="Watches Prishtina, ballina">
            <span class="wordmark-symbol">W</span>
            <span>WATCHES <small>PRISHTINA</small></span>
        </a>

        <nav class="main-nav" data-main-nav>
            <a class="<?= $currentPath === '/' ? 'active' : ''; ?>" href="<?= e(url()); ?>">Ballina</a>
            <a class="<?= $currentPath === '/shop' ? 'active' : ''; ?>" href="<?= e(url('shop')); ?>">Koleksioni</a>
            <a class="<?= str_starts_with($currentPath, '/blog') ? 'active' : ''; ?>" href="<?= e(url('blog')); ?>">Blog</a>
            <a class="<?= $currentPath === '/sell-watch' ? 'active' : ''; ?>" href="<?= e(url('sell-watch')); ?>">Shit oren</a>
            <a class="<?= $currentPath === '/about' ? 'active' : ''; ?>" href="<?= e(url('about')); ?>">Rreth nesh</a>
            <a class="<?= $currentPath === '/contact' ? 'active' : ''; ?>" href="<?= e(url('contact')); ?>">Kontakt</a>
            <?php if (is_admin()): ?>
                <a href="<?= e(url('admin')); ?>">Admin</a>
            <?php endif; ?>
        </nav>

        <div class="nav-actions">
            <a class="icon-button" href="<?= e(url('shop')); ?>" aria-label="Kerko">
                <i data-lucide="search"></i>
            </a>
            <a class="icon-button" href="<?= e(url('favorites')); ?>" aria-label="Lista e deshirave">
                <i data-lucide="heart"></i>
                <span class="action-count" data-favorites-count <?= $favoriteCount ? '' : 'hidden'; ?>><?= (int) $favoriteCount; ?></span>
            </a>
            <a class="icon-button" href="<?= e(url('cart')); ?>" aria-label="Shporta">
                <i data-lucide="shopping-bag"></i>
                <span class="action-count" data-cart-count <?= $cartCount ? '' : 'hidden'; ?>><?= (int) $cartCount; ?></span>
            </a>
            <?php if (is_authenticated()): ?>
                <form method="post" action="<?= e(url('logout')); ?>" class="nav-logout">
                    <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
                    <button class="icon-button" type="submit" aria-label="Ckycu"><i data-lucide="log-out"></i></button>
                </form>
            <?php else: ?>
                <a class="icon-button" href="<?= e(url('login')); ?>" aria-label="Kycu"><i data-lucide="user"></i></a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main>
<?php if ($flashMessage): ?>
    <div class="global-flash <?= e($flashMessage['type']); ?>" data-global-flash>
        <?= e($flashMessage['message']); ?>
        <button type="button" aria-label="Mbyll" data-flash-close><i data-lucide="x"></i></button>
    </div>
<?php endif; ?>
