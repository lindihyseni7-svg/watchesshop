<section class="home-hero">
    <div class="hero-overlay"></div>
    <div class="hero-copy">
        <span class="kicker">Koleksioni 2026</span>
        <h1>Koha, e zgjedhur mire.</h1>
        <p>Ore me karakter, histori dhe inxhinieri qe zgjat pertej trendeve.</p>
        <div class="hero-actions">
            <a class="button button-light" href="<?= e(url('shop')); ?>">Shfleto koleksionin <i data-lucide="arrow-up-right"></i></a>
            <a class="text-link light" href="<?= e(url('shop?sort=newest')); ?>">Zbulo New In <i data-lucide="arrow-right"></i></a>
        </div>
    </div>
    <div class="hero-index">01 <span>/ 03</span></div>
</section>

<section class="moving-gallery" aria-label="Koleksione te zgjedhura">
    <div class="gallery-track">
        <?php
        $galleryProducts = array_merge($featured, $featured);
        foreach ($galleryProducts as $item):
        ?>
            <a class="gallery-item" href="<?= e(url('product/' . $item['slug'])); ?>">
                <img src="<?= e(product_image($item['image'])); ?>" alt="<?= e($item['emri']); ?>">
                <span><strong><?= e($item['brand']); ?></strong><?= e($item['modeli']); ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="content-section">
    <div class="section-title-row">
        <div>
            <span class="kicker dark">Te zgjedhurat</span>
            <h2>Ora qe flasin pa zhurme</h2>
        </div>
        <a class="text-link" href="<?= e(url('shop?sort=popular')); ?>">Shiko te gjitha <i data-lucide="arrow-right"></i></a>
    </div>
    <div class="product-grid">
        <?php foreach ($featured as $product) require VIEW_PATH . '/components/product-card.php'; ?>
    </div>
</section>

<section class="editorial-band">
    <div class="editorial-image">
        <img src="<?= e(url('img/section2.jpg')); ?>" alt="Detaje te ores premium">
    </div>
    <div class="editorial-copy">
        <span class="kicker">Mjeshteria</span>
        <h2>Nje mekanizem. Qindra pjese. Nje moment perfekt.</h2>
        <p>Ne zgjedhim modele qe balancojne traditen, precizionin dhe dizajnin. Secila ore kontrollohet para se te arrije tek ju.</p>
        <a class="button button-outline-light" href="<?= e(url('about')); ?>">Historia jone <i data-lucide="arrow-right"></i></a>
    </div>
</section>

<section class="content-section">
    <div class="section-title-row">
        <div>
            <span class="kicker dark">Sapo arriten</span>
            <h2>New in</h2>
        </div>
        <a class="text-link" href="<?= e(url('shop?sort=newest')); ?>">Shiko koleksionin <i data-lucide="arrow-right"></i></a>
    </div>
    <div class="product-grid">
        <?php foreach ($newest as $product) require VIEW_PATH . '/components/product-card.php'; ?>
    </div>
</section>

<section class="brand-marquee">
    <div class="brand-track">
        <?php foreach (array_merge($brands, $brands) as $brand): ?>
            <a href="<?= e(url('shop?brand=' . rawurlencode($brand['brand']))); ?>">
                <?= e(strtoupper($brand['brand'])); ?>
                <small><?= (int) $brand['total']; ?> modele</small>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="service-strip">
    <article><i data-lucide="shield-check"></i><div><strong>Autenticitet i garantuar</strong><span>Kontroll profesional per cdo ore</span></div></article>
    <article><i data-lucide="truck"></i><div><strong>Transport i sigurt</strong><span>Paketim premium dhe gjurmim</span></div></article>
    <article><i data-lucide="rotate-ccw"></i><div><strong>14 dite kthim</strong><span>Bli i qete, vendos pa presion</span></div></article>
    <article><i data-lucide="headphones"></i><div><strong>Keshillim personal</strong><span>Na kontakto per modelin e duhur</span></div></article>
</section>

