<?php // AJAX-enabled shopping cart and order summary. ?>
<section class="page-hero compact light-hero">
    <span class="kicker dark">Porosia</span>
    <h1>Shporta jote</h1>
    <p>Kontrollo modelet dhe sasite para se te vazhdosh.</p>
</section>

<section class="cart-layout" data-cart-page>
    <div class="cart-items">
        <?php if ($cart['items']): ?>
            <?php foreach ($cart['items'] as $item): $product = $item['product']; ?>
                <article class="cart-row" data-cart-row="<?= (int) $product['id']; ?>">
                    <a href="<?= e(url('product/' . $product['slug'])); ?>" class="cart-image">
                        <img src="<?= e(product_image($product['image'])); ?>" alt="<?= e($product['emri']); ?>">
                    </a>
                    <div class="cart-product-copy">
                        <span><?= e($product['brand']); ?></span>
                        <h2><a href="<?= e(url('product/' . $product['slug'])); ?>"><?= e($product['emri']); ?></a></h2>
                        <p><?= e($product['modeli']); ?></p>
                        <button type="button" class="remove-link" data-cart-remove="<?= (int) $product['id']; ?>">Largo</button>
                    </div>
                    <div class="quantity-stepper compact">
                        <button type="button" data-cart-decrease="<?= (int) $product['id']; ?>" aria-label="Zbrit"><i data-lucide="minus"></i></button>
                        <input type="number" value="<?= (int) $item['quantity']; ?>" min="1" max="10" data-cart-quantity="<?= (int) $product['id']; ?>" aria-label="Sasia">
                        <button type="button" data-cart-increase="<?= (int) $product['id']; ?>" aria-label="Rrit"><i data-lucide="plus"></i></button>
                    </div>
                    <strong class="cart-line-price">$<?= money($item['subtotal']); ?></strong>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i data-lucide="shopping-bag"></i>
                <h2>Shporta eshte bosh</h2>
                <p>Koleksioni po te pret.</p>
                <a class="button button-dark" href="<?= e(url('shop')); ?>">Fillo blerjen</a>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($cart['items']): ?>
        <aside class="order-summary">
            <h2>Permbledhja</h2>
            <div><span>Nentotali</span><strong data-cart-total>$<?= money($cart['total']); ?></strong></div>
            <div><span>Transporti</span><strong>Falas</strong></div>
            <div class="summary-total"><span>Totali</span><strong data-cart-total>$<?= money($cart['total']); ?></strong></div>
            <button class="button button-dark full" type="button" data-checkout>Vazhdo ne pagese <i data-lucide="arrow-right"></i></button>
            <p><i data-lucide="lock"></i> Pagesa procesohet ne menyre te sigurt.</p>
        </aside>
    <?php endif; ?>
</section>
