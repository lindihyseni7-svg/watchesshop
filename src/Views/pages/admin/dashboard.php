<?php
// Administrator overview with counts from all managed modules.
$modules = [
    ['key' => 'products', 'label' => 'Produkte', 'icon' => 'watch', 'route' => 'products'],
    ['key' => 'users', 'label' => 'Perdorues', 'icon' => 'users', 'route' => 'users'],
    ['key' => 'brands', 'label' => 'Brende', 'icon' => 'badge', 'route' => 'brands'],
    ['key' => 'categories', 'label' => 'Kategori', 'icon' => 'layers-3', 'route' => 'categories'],
    ['key' => 'offers', 'label' => 'Oferta', 'icon' => 'badge-percent', 'route' => 'offers'],
    ['key' => 'messages', 'label' => 'Mesazhe', 'icon' => 'mail', 'route' => 'messages'],
    ['key' => 'newsletter', 'label' => 'Newsletter', 'icon' => 'send', 'route' => 'newsletter'],
    ['key' => 'watch_sale_requests', 'label' => 'Shitje orash', 'icon' => 'hand-coins', 'route' => 'watch-sale-requests'],
    ['key' => 'orders', 'label' => 'Porosi', 'icon' => 'receipt-text', 'route' => 'orders'],
    ['key' => 'order_items', 'label' => 'Order items', 'icon' => 'list-ordered', 'route' => 'order-items'],
];
?>
<section class="admin-shell">
    <?php require VIEW_PATH . '/components/admin-nav.php'; ?>
    <div class="admin-workspace">
        <header class="admin-page-header">
            <div><span class="kicker dark">Watches Prishtina</span><h1>Dashboard</h1><p>Kontroll i katalogut, perdoruesve dhe ofertave nga nje vend.</p></div>
            <?php if (can_mutate_admin()): ?>
                <a class="button button-dark" href="<?= e(url('admin/products/create')); ?>"><i data-lucide="plus"></i> Shto produkt</a>
            <?php else: ?>
                <button class="button button-dark" type="button" data-demo-disabled><i data-lucide="lock"></i> Demo read-only</button>
            <?php endif; ?>
        </header>
        <?php if (is_demo_admin()): ?>
            <div class="admin-demo-banner">
                <i data-lucide="shield-alert"></i>
                <div>
                    <strong>Demo admin read-only</strong>
                    <span>Kjo llogari eshte vetem per te shikuar panelin. Ndryshimet jane te bllokuara per te mbrojtur te dhenat e projektit.</span>
                </div>
            </div>
        <?php endif; ?>
        <div class="admin-metric-grid">
            <?php foreach ($modules as $module): ?>
                <article>
                    <i data-lucide="<?= e($module['icon']); ?>"></i>
                    <span><?= e($module['label']); ?></span>
                    <strong><?= (int) ($counts[$module['key']] ?? 0); ?></strong>
                    <?php if ($module['route']): ?><a href="<?= e(url('admin/' . $module['route'])); ?>">Menaxho <i data-lucide="arrow-up-right"></i></a><?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="admin-info-band">
            <div><i data-lucide="database"></i><span><strong>Databaza aktive</strong>MySQL ne XAMPP, e versionuar me migrations ne projekt.</span></div>
            <div><i data-lucide="shield-check"></i><span><strong>Qasje e mbrojtur</strong>Administratori menaxhon te dhenat; demo admini mund t'i shikoje pa bere ndryshime.</span></div>
        </div>
    </div>
</section>
