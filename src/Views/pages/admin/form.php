<?php
// Reusable create/edit form generated from safe server-side entity configuration.
$action = $recordId
    ? url('admin/' . $entity . '/' . $recordId . '/edit')
    : url('admin/' . $entity . '/create');
?>
<section class="admin-shell">
    <?php require VIEW_PATH . '/components/admin-nav.php'; ?>
    <div class="admin-workspace">
        <header class="admin-page-header">
            <div><span class="kicker dark"><?= $recordId ? 'Modifikim' : 'Regjistrim i ri'; ?></span><h1><?= $recordId ? 'Modifiko ' : 'Shto '; ?><?= e(strtolower($config['singular'])); ?></h1></div>
            <a class="button button-outline" href="<?= e(url('admin/' . $entity)); ?>"><i data-lucide="arrow-left"></i> Kthehu</a>
        </header>
        <?php if (is_demo_admin()): ?>
            <div class="admin-demo-banner compact">
                <i data-lucide="lock"></i>
                <div>
                    <strong>Ky formular eshte vetem per shikim</strong>
                    <span>Nese klikon ruaj, sistemi do ta ndaloje veprimin sepse vetem administratori real mund te ndryshoje te dhenat.</span>
                </div>
            </div>
        <?php endif; ?>
        <form method="post" action="<?= e($action); ?>" class="admin-form <?= is_demo_admin() ? 'readonly-demo' : ''; ?>" <?= is_demo_admin() ? 'data-demo-operation' : ''; ?>>
            <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
            <?php if (isset($errors['general'])): ?><div class="form-alert error"><?= e($errors['general']); ?></div><?php endif; ?>
            <div class="admin-form-grid">
                <?php foreach ($config['fields'] as $column => $field): ?>
                    <?php
                    $type = $field['type'] ?? 'text';
                    $value = $type === 'password' ? '' : ($record[$column] ?? '');
                    $wide = $type === 'textarea' ? 'wide' : '';
                    ?>
                    <label class="<?= $wide; ?>">
                        <span><?= e($field['label']); ?><?= !empty($field['required']) ? ' *' : ''; ?></span>
                        <?php if ($type === 'textarea'): ?>
                            <textarea name="<?= e($column); ?>" rows="6" <?= !empty($field['required']) ? 'required' : ''; ?>><?= e($value); ?></textarea>
                        <?php elseif ($type === 'select'): ?>
                            <select name="<?= e($column); ?>" <?= !empty($field['required']) ? 'required' : ''; ?>>
                                <?php if (empty($field['required'])): ?><option value="">Pa zgjedhje</option><?php endif; ?>
                                <?php
                                $options = $dynamicOptions[$column] ?? [];
                                if (!$options) {
                                    foreach (($field['options'] ?? []) as $optionValue => $optionLabel) {
                                        $options[] = ['value' => $optionValue, 'label' => $optionLabel];
                                    }
                                }
                                foreach ($options as $option):
                                ?>
                                    <option value="<?= e($option['value']); ?>" <?= (string) $value === (string) $option['value'] ? 'selected' : ''; ?>><?= e($option['label']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                            <input type="<?= e($type); ?>" name="<?= e($column); ?>" value="<?= e($value); ?>" step="<?= e($field['step'] ?? '1'); ?>" placeholder="<?= e($field['placeholder'] ?? ''); ?>" <?= !empty($field['required']) && !($recordId && $type === 'password') ? 'required' : ''; ?>>
                        <?php endif; ?>
                        <?php if (!empty($field['help'])): ?><small><?= e($field['help']); ?></small><?php endif; ?>
                        <?php if (isset($errors[$column])): ?><small class="field-error"><?= e($errors[$column]); ?></small><?php endif; ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <div class="admin-form-actions">
                <button class="button button-dark" type="<?= is_demo_admin() ? 'button' : 'submit'; ?>" <?= is_demo_admin() ? 'data-demo-disabled' : ''; ?>><i data-lucide="<?= is_demo_admin() ? 'lock' : 'save'; ?>"></i> <?= is_demo_admin() ? 'Ndryshimet jane te bllokuara' : 'Ruaj ndryshimet'; ?></button>
                <a class="button button-outline" href="<?= e(url('admin/' . $entity)); ?>">Anulo</a>
            </div>
        </form>
    </div>
</section>
