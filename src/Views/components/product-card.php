<?php
// Reusable catalog card with calculated discount, favorite and AJAX cart controls.
$isFavorite = in_array((int) $product['id'], $favoriteIds ?? [], true);
$discount = (float) $product['discount_percent'];
$finalPrice = (float) $product['cmimi'] * (1 - $discount / 100);
$stock = (int) ($product['stock'] ?? 0);
?>
<article class="product-card" data-product-card="<?= (int) $product['id']; ?>">
    <div class="product-media">
        <a href="<?= e(url('product/' . $product['slug'])); ?>" aria-label="<?= e($product['emri']); ?>">
            <img src="<?= e(product_image($product['image'])); ?>" alt="<?= e($product['emri']); ?>" loading="lazy">
        </a>
        <div class="product-badges">
            <?php if ((int) $product['is_new'] === 1): ?><span class="badge badge-new">New</span><?php endif; ?>
            <?php if ($discount > 0): ?><span class="badge badge-sale">-<?= (int) $discount; ?>%</span><?php endif; ?>
        </div>
        <button class="favorite-button <?= $isFavorite ? 'active' : ''; ?>" type="button" data-favorite="<?= (int) $product['id']; ?>" aria-label="Ruaj ne liste">
            <i data-lucide="heart"></i>
        </button>
        <button class="quick-add" type="button" data-add-cart="<?= (int) $product['id']; ?>">
            <i data-lucide="shopping-bag"></i>
            <span>Shto ne shporte</span>
        </button>
    </div>
    <div class="product-info">
        <div class="product-brand"><?= e($product['brand']); ?></div>
        <h3><a href="<?= e(url('product/' . $product['slug'])); ?>"><?= e($product['emri']); ?></a></h3>
        <p><?= e($product['modeli']); ?></p>
        <div class="product-price">
            <strong>$<?= money($finalPrice); ?></strong>
            <?php if ($discount > 0): ?><del>$<?= money($product['cmimi']); ?></del><?php endif; ?>
        </div>
        <div class="product-stock <?= $stock > 0 ? 'available' : 'unavailable'; ?>">
            <span></span><?= $stock > 0 ? 'Ne stok' : 'Jashte stokut'; ?>
        </div>
    </div>
</article>
