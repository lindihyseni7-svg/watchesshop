<?php
// Product detail page with price, history, specifications and related products.
$discount = (float) $product['discount_percent'];
$finalPrice = (float) $product['cmimi'] * (1 - $discount / 100);
$isFavorite = in_array((int) $product['id'], $favoriteIds, true);
$copy = product_copy($product);
?>
<div class="breadcrumbs">
    <a href="<?= e(url()); ?>">Ballina</a><i data-lucide="chevron-right"></i>
    <a href="<?= e(url('shop?brand=' . rawurlencode($product['brand']))); ?>"><?= e($product['brand']); ?></a><i data-lucide="chevron-right"></i>
    <span><?= e($product['modeli']); ?></span>
</div>

<section class="product-detail">
    <div class="product-detail-media">
        <img src="<?= e(product_image($product['image'])); ?>" alt="<?= e($product['emri']); ?>">
        <span class="image-note"><i data-lucide="maximize-2"></i> Pamje e produktit</span>
    </div>

    <div class="product-detail-info">
        <span class="kicker dark"><?= e($product['brand']); ?></span>
        <h1><?= e($product['emri']); ?></h1>
        <p class="reference">Reference <?= e($product['modeli']); ?></p>
        <div class="detail-price">
            <strong>$<?= money($finalPrice); ?></strong>
            <?php if ($discount > 0): ?><del>$<?= money($product['cmimi']); ?></del><span>Kursen <?= (int) $discount; ?>%</span><?php endif; ?>
        </div>
        <p class="lead"><?= e($copy['description']); ?></p>

        <div class="stock-line <?= (int) $product['stock'] > 0 ? 'available' : ''; ?>">
            <span></span><?= (int) $product['stock'] > 0 ? 'Ne stok, gati per dergese' : 'Per momentin nuk ka stok'; ?>
        </div>

        <div class="purchase-row">
            <div class="quantity-stepper">
                <button type="button" data-qty-minus aria-label="Zbrit sasine"><i data-lucide="minus"></i></button>
                <input type="number" value="1" min="1" max="10" data-qty-input aria-label="Sasia">
                <button type="button" data-qty-plus aria-label="Rrit sasine"><i data-lucide="plus"></i></button>
            </div>
            <button class="button button-dark grow" type="button" data-add-cart="<?= (int) $product['id']; ?>" data-quantity-source="[data-qty-input]">
                Shto ne shporte <i data-lucide="shopping-bag"></i>
            </button>
            <button class="favorite-large <?= $isFavorite ? 'active' : ''; ?>" type="button" data-favorite="<?= (int) $product['id']; ?>" aria-label="Ruaj ne liste"><i data-lucide="heart"></i></button>
        </div>

        <div class="detail-services">
            <span><i data-lucide="shield-check"></i> Garanci autenticiteti</span>
            <span><i data-lucide="truck"></i> Transport i siguruar</span>
            <span><i data-lucide="rotate-ccw"></i> 14 dite kthim</span>
        </div>
    </div>
</section>

<section class="product-story">
    <div>
        <span class="kicker dark">Historia</span>
        <h2>Me shume se matje kohe</h2>
    </div>
    <p><?= e($copy['story']); ?></p>
</section>

<section class="spec-section">
    <div class="section-title-row"><h2>Detajet teknike</h2></div>
    <dl class="spec-grid">
        <div><dt>Brendi</dt><dd><?= e($product['brand']); ?></dd></div>
        <div><dt>Modeli</dt><dd><?= e($product['modeli']); ?></dd></div>
        <div><dt>Mekanizmi</dt><dd><?= e($product['movement']); ?></dd></div>
        <div><dt>Materiali</dt><dd><?= e($product['material']); ?></dd></div>
        <div><dt>Rezistenca ne uje</dt><dd><?= e($product['water_resistance']); ?></dd></div>
        <div><dt>Disponueshmeria</dt><dd><?= (int) $product['stock']; ?> cope</dd></div>
    </dl>
</section>

<?php if ($related): ?>
<section class="content-section related-products">
    <div class="section-title-row"><h2>Mund te te pelqejne</h2><a class="text-link" href="<?= e(url('shop?brand=' . rawurlencode($product['brand']))); ?>">Shiko <?= e($product['brand']); ?> <i data-lucide="arrow-right"></i></a></div>
    <div class="product-grid">
        <?php foreach ($related as $product) require VIEW_PATH . '/components/product-card.php'; ?>
    </div>
</section>
<?php endif; ?>
