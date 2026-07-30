<?php // Customer favorite products resolved from the current session. ?>
<section class="page-hero compact light-hero">
    <span class="kicker dark">Lista personale</span>
    <h1>Te preferuarat</h1>
    <p>Modelet qe ke ruajtur per t'i krahasuar dhe vizituar perseri.</p>
</section>

<section class="content-section favorites-page">
    <?php if ($products): ?>
        <div class="product-grid">
            <?php foreach ($products as $product) require VIEW_PATH . '/components/product-card.php'; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i data-lucide="heart"></i>
            <h2>Lista eshte ende bosh</h2>
            <p>Prek zemren tek nje ore dhe ajo do te ruhet ketu.</p>
            <a class="button button-dark" href="<?= e(url('shop')); ?>">Zbulo koleksionin</a>
        </div>
    <?php endif; ?>
</section>
