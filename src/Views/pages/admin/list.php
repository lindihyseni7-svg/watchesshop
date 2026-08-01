<?php
// Reusable responsive table for every configured CRUD entity.
$primaryKey = $config['primary_key'];
$hasForm = !empty($config['fields']) && empty($config['readonly']);
$canDelete = empty($config['readonly']);
?>
<section class="admin-shell">
    <?php require VIEW_PATH . '/components/admin-nav.php'; ?>
    <div class="admin-workspace">
        <header class="admin-page-header">
            <div><span class="kicker dark">Administrimi</span><h1><?= e($config['label']); ?></h1><p><?= count($rows); ?> regjistrime ne databaze.</p></div>
            <?php if (can_mutate_admin() && $hasForm): ?>
                <a class="button button-dark" href="<?= e(url('admin/' . $entity . '/create')); ?>"><i data-lucide="plus"></i> Shto <?= e(strtolower($config['singular'])); ?></a>
            <?php elseif (!empty($config['readonly'])): ?>
                <button class="button button-dark" type="button" data-demo-disabled><i data-lucide="eye"></i> Tabele read-only</button>
            <?php else: ?>
                <button class="button button-dark" type="button" data-demo-disabled><i data-lucide="lock"></i> Vetem shikim</button>
            <?php endif; ?>
        </header>
        <?php if (is_demo_admin()): ?>
            <div class="admin-demo-banner compact">
                <i data-lucide="eye"></i>
                <div>
                    <strong>Panel demo</strong>
                    <span>Mund te hapesh regjistrimet dhe t'i shikosh, por ruajtja dhe fshirja jane te bllokuara.</span>
                </div>
            </div>
        <?php endif; ?>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead><tr>
                    <?php foreach ($config['list'] as $label): ?><th><?= e($label); ?></th><?php endforeach; ?>
                    <?php if ($hasForm || $canDelete): ?><th class="actions-column">Veprimet</th><?php endif; ?>
                </tr></thead>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php foreach ($config['list'] as $column => $label): ?>
                            <td>
                                <?php if ($column === 'image'): ?>
                                    <img class="admin-product-thumb" src="<?= e(product_image($row[$column] ?? null)); ?>" alt="">
                                <?php elseif (in_array($column, ['cmimi', 'kostoja', 'grand_total', 'subtotal', 'shipping_total', 'unit_price', 'line_total', 'estimated_value_min', 'estimated_value_max'], true)): ?>
                                    $<?= money($row[$column] ?? 0); ?>
                                <?php elseif (in_array($column, ['discount_percent', 'Zbritja'], true)): ?>
                                    <?= money($row[$column] ?? 0); ?>%
                                <?php elseif ($column === 'is_active'): ?>
                                    <?= (int) ($row[$column] ?? 0) === 1 ? 'Po' : 'Jo'; ?>
                                <?php elseif (in_array($column, ['message', 'notes', 'shipping_address'], true)): ?>
                                    <?php $cellText = (string) ($row[$column] ?? '-'); ?>
                                    <span class="admin-cell-muted"><?= e(strlen($cellText) > 90 ? substr($cellText, 0, 90) . '...' : $cellText); ?></span>
                                <?php else: ?>
                                    <?= e($row[$column] ?? '-'); ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                        <?php if ($hasForm || $canDelete): ?>
                            <td class="table-actions">
                                <?php if ($hasForm): ?><a class="icon-button" href="<?= e(url('admin/' . $entity . '/' . $row[$primaryKey] . '/edit')); ?>" aria-label="Modifiko"><i data-lucide="pencil"></i></a><?php endif; ?>
                                <?php if ($canDelete): ?>
                                    <form method="post" action="<?= e(url('admin/' . $entity . '/' . $row[$primaryKey] . '/delete')); ?>" <?= is_demo_admin() ? 'data-demo-operation' : 'data-confirm-delete'; ?>>
                                        <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
                                        <button class="icon-button danger-icon" type="submit" aria-label="Fshij"><i data-lucide="trash-2"></i></button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$rows): ?><tr><td colspan="<?= count($config['list']) + (($hasForm || $canDelete) ? 1 : 0); ?>" class="table-empty">Nuk ka regjistrime.</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
