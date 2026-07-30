<?php
// Sidebar navigation shared by all administrator views.
$adminPath = request_path();
$adminLinks = [
    'admin' => ['label' => 'Dashboard', 'icon' => 'layout-dashboard'],
    'admin/products' => ['label' => 'Produktet', 'icon' => 'watch'],
    'admin/users' => ['label' => 'Perdoruesit', 'icon' => 'users'],
    'admin/brands' => ['label' => 'Brendet', 'icon' => 'badge'],
    'admin/categories' => ['label' => 'Kategorite', 'icon' => 'layers-3'],
    'admin/offers' => ['label' => 'Ofertat', 'icon' => 'badge-percent'],
];
?>
<aside class="admin-sidebar">
    <div class="admin-identity">
        <span>Paneli</span>
        <strong><?= e(current_user()['name'] ?? 'Administrator'); ?></strong>
        <small><?= e(current_user()['email'] ?? ''); ?></small>
    </div>
    <nav>
        <?php foreach ($adminLinks as $path => $item): ?>
            <?php $active = $path === 'admin' ? $adminPath === '/admin' : str_starts_with($adminPath, '/' . $path); ?>
            <a class="<?= $active ? 'active' : ''; ?>" href="<?= e(url($path)); ?>">
                <i data-lucide="<?= e($item['icon']); ?>"></i><?= e($item['label']); ?>
            </a>
        <?php endforeach; ?>
    </nav>
    <a class="admin-store-link" href="<?= e(url()); ?>"><i data-lucide="store"></i> Kthehu ne dyqan</a>
</aside>

