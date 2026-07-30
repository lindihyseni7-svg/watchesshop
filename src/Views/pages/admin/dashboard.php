<?php
// Administrator overview with counts from all managed modules.
$modules = [
    ['key' => 'products', 'label' => 'Produkte', 'icon' => 'watch', 'route' => 'products'],
    ['key' => 'users', 'label' => 'Perdorues', 'icon' => 'users', 'route' => 'users'],
    ['key' => 'brands', 'label' => 'Brende', 'icon' => 'badge', 'route' => 'brands'],
    ['key' => 'categories', 'label' => 'Kategori', 'icon' => 'layers-3', 'route' => 'categories'],
    ['key' => 'offers', 'label' => 'Oferta', 'icon' => 'badge-percent', 'route' => 'offers'],
    ['key' => 'messages', 'label' => 'Mesazhe', 'icon' => 'mail', 'route' => null],
];
?>
<section class="admin-shell">
    <?php require VIEW_PATH . '/components/admin-nav.php'; ?>
    <div class="admin-workspace">
        <header class="admin-page-header">
            <div><span class="kicker dark">Watches Prishtina</span><h1>Dashboard</h1><p>Kontroll i katalogut, perdoruesve dhe ofertave nga nje vend.</p></div>
            <a class="button button-dark" href="<?= e(url('admin/products/create')); ?>"><i data-lucide="plus"></i> Shto produkt</a>
        </header>
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
            <div><i data-lucide="shield-check"></i><span><strong>Qasje e mbrojtur</strong>Vetem roli Administrator mund te hyje ne keto routes.</span></div>
        </div>
    </div>
</section>

