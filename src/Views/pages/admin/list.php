<?php
// Reusable responsive table for every configured CRUD entity.
$primaryKey = $config['primary_key'];
?>
<section class="admin-shell">
    <?php require VIEW_PATH . '/components/admin-nav.php'; ?>
    <div class="admin-workspace">
        <header class="admin-page-header">
            <div><span class="kicker dark">Administrimi</span><h1><?= e($config['label']); ?></h1><p><?= count($rows); ?> regjistrime ne databaze.</p></div>
            <a class="button button-dark" href="<?= e(url('admin/' . $entity . '/create')); ?>"><i data-lucide="plus"></i> Shto <?= e(strtolower($config['singular'])); ?></a>
        </header>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead><tr>
                    <?php foreach ($config['list'] as $label): ?><th><?= e($label); ?></th><?php endforeach; ?>
                    <th class="actions-column">Veprimet</th>
                </tr></thead>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php foreach ($config['list'] as $column => $label): ?>
                            <td>
                                <?php if ($column === 'image'): ?>
                                    <img class="admin-product-thumb" src="<?= e(product_image($row[$column] ?? null)); ?>" alt="">
                                <?php elseif (in_array($column, ['cmimi', 'kostoja'], true)): ?>
                                    $<?= money($row[$column] ?? 0); ?>
                                <?php elseif (in_array($column, ['discount_percent', 'Zbritja'], true)): ?>
                                    <?= money($row[$column] ?? 0); ?>%
                                <?php else: ?>
                                    <?= e($row[$column] ?? '-'); ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                        <td class="table-actions">
                            <a class="icon-button" href="<?= e(url('admin/' . $entity . '/' . $row[$primaryKey] . '/edit')); ?>" aria-label="Modifiko"><i data-lucide="pencil"></i></a>
                            <form method="post" action="<?= e(url('admin/' . $entity . '/' . $row[$primaryKey] . '/delete')); ?>" data-confirm-delete>
                                <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
                                <button class="icon-button danger-icon" type="submit" aria-label="Fshij"><i data-lucide="trash-2"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$rows): ?><tr><td colspan="<?= count($config['list']) + 1; ?>" class="table-empty">Nuk ka regjistrime.</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

