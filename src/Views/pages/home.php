<?php
// Homepage with premium image hero, curated product rails and editorial sections.
$brandImages = [
    'Alpina' => 'img/alpina-pink-card.webp',
    'Breitling' => 'img/o0.jpg',
    'Bulova' => 'img/bulova-chronograph-card.jpg',
    'Cartier' => 'img/o1.jpg',
    'Casio' => 'img/smart-watch-card.jpg',
    'Citizen' => 'img/diesel-blue-card.webp',
    'Frederique Constant' => 'img/alpina-pink-card.webp',
    'Hamilton' => 'img/diesel-red-card.jpg',
    'IWC' => 'img/emporio-armani-diver-card.jpg',
    'Longines' => 'img/gucci-blue-card.jpg',
    'Mido' => 'img/o6.jpg',
    'Nomos' => 'img/bulova-rectangular-card.jpg',
    'Omega' => 'img/rolex-sea-dweller-card.webp',
    'Orient' => 'img/smart-watch-card.jpg',
    'Panerai' => 'img/o6.jpg',
    'Rado' => 'img/seiko-black-card.webp',
    'Rolex' => 'img/o34.jpg',
    'Seiko' => 'img/seiko-black-card.webp',
    'TAG Heuer' => 'img/emporio-armani-diver-card.jpg',
    'Tissot' => 'img/alpina-pink-card.webp',
    'Tudor' => 'img/o34.jpg',
    'Zenith' => 'img/o1.jpg',
];
?>
<section class="home-hero image-hero" style="background-image: url('<?= e(asset('images/hero-watches.png')); ?>');">
    <div class="hero-overlay"></div>
    <div class="hero-copy">
        <span class="kicker">Watches Prishtina</span>
        <h1>Koha qe ndihet premium.</h1>
        <p>Koleksion i kuruar me ora klasike, sportive dhe smart per momente qe kerkojne prezence.</p>
        <div class="hero-actions">
            <a class="button button-light" href="<?= e(url('shop')); ?>">Shfleto koleksionin <i data-lucide="arrow-up-right"></i></a>
            <a class="text-link light" href="<?= e(url('shop?discount=1&sort=discount_desc')); ?>">Shiko ofertat <i data-lucide="arrow-right"></i></a>
        </div>
    </div>
</section>

<section class="moving-gallery" aria-label="Koleksione te zgjedhura" data-marquee>
    <button class="icon-button marquee-toggle" type="button" data-marquee-toggle aria-label="Ndalo levizjen" title="Ndalo levizjen"><i data-lucide="pause"></i></button>
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

<section class="offer-band">
    <img src="<?= e(safe_image('img/oferta.jpg')); ?>" alt="Ofertat e orave Watches Prishtina">
    <div class="offer-copy">
        <div>
            <span class="kicker">Ofertat</span>
            <h2>Modele te zgjedhura. Zbritje reale.</h2>
        </div>
        <p>Shfleto ofertat aktive ne katalog dhe gjej modelin e duhur me cmim me te mire.</p>
        <a class="button button-light" href="<?= e(url('shop?discount=1&sort=discount_desc')); ?>">Shiko ofertat <i data-lucide="tag"></i></a>
    </div>
</section>

<section class="editorial-band">
    <div class="editorial-image">
        <img src="<?= e(safe_image('img/pikat.jpg')); ?>" alt="Koleksioni premium i orave">
    </div>
    <div class="editorial-copy">
        <span class="kicker">Koleksioni</span>
        <h2>Nje vitrine e qarte per modele qe meritojne vemendje.</h2>
        <p>Fotografi te medha, kontrast i paster dhe fokus te ora. Eksperienca eshte ndertuar qe produkti te flase para tekstit.</p>
        <a class="button button-outline-light" href="<?= e(url('about')); ?>">Historia jone <i data-lucide="arrow-right"></i></a>
    </div>
</section>

<section class="museum-section">
    <div class="museum-media">
        <img src="<?= e(safe_image('img/bulova-heritage-section.png')); ?>" alt="Arkive vizuale Bulova">
    </div>
    <div class="museum-copy">
        <span class="timeline-rule" aria-hidden="true"></span>
        <span class="kicker dark">Interactive Museum</span>
        <h2>Historia e ores, e treguar me imazh dhe detaj.</h2>
        <p>Trashgimia e brendeve si Bulova na kujton se nje ore nuk eshte vetem aksesore. Ajo mban dizajn, teknologji dhe momente qe kalojne nga nje brez te tjetri.</p>
        <a class="button button-dark" href="<?= e(url('about')); ?>">Me shume <i data-lucide="arrow-right"></i></a>
    </div>
</section>

<section class="durability-section">
    <div class="durability-copy">
        <span class="kicker dark">Qendrueshmeri</span>
        <h2>Used by men who do not get days off.</h2>
        <p>Ora per dite te gjata duhet te jete e lexueshme, solide dhe e rehatshme. Modelet sportive ne katalog jane zgjedhur per materiale te forta, rezistence dhe prezence moderne.</p>
        <a class="text-link" href="<?= e(url('shop?brand=Casio')); ?>">Shiko modelet sportive <i data-lucide="arrow-right"></i></a>
    </div>
    <img src="<?= e(safe_image('img/used-by-men-who-dont-get-days-off.webp')); ?>" alt="Ore sportive e perdorur ne pune te rende">
</section>

<section class="comparison-section">
    <div class="comparison-copy">
        <span class="kicker dark">Materialet</span>
        <h2>Cfare e ben nje ore te ndihet me e forte?</h2>
        <p>Kasa, xhami, rripi dhe rezistenca ndaj ujit ndryshojne shume nga modeli ne model. Prandaj ne faqe i japim hapesire detajeve qe klienti te kuptoje pse nje ore kushton dhe zgjat me shume.</p>
    </div>
    <img src="<?= e(safe_image('img/tabla-section.webp')); ?>" alt="Tabele krahasimi per materiale dhe rezistence">
</section>

<section class="release-section">
    <div class="release-watch">
        <img src="<?= e(safe_image('img/release-watch-cutout.png')); ?>" alt="Ore automatike me dial blu">
    </div>
    <div class="release-copy">
        <span class="kicker">Join the Watch Pages</span>
        <h2>Never miss a release</h2>
        <p>Ruaj oret favorite, ndiq brendet qe pelqen dhe kthehu shpejt te koleksioni kur del dicka e re.</p>
        <a class="button button-light" href="<?= e(url('register')); ?>">Get started</a>
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

<section class="brand-marquee" aria-label="Brendet" data-marquee>
    <button class="icon-button marquee-toggle" type="button" data-marquee-toggle aria-label="Ndalo levizjen" title="Ndalo levizjen"><i data-lucide="pause"></i></button>
    <div class="brand-marquee-heading">
        <span class="kicker dark">Brendet</span>
        <strong>Ikona qe levizin me koleksionin</strong>
    </div>
    <div class="brand-track">
        <?php foreach (array_merge($brands, $brands) as $brand): ?>
            <?php $brandImage = $brandImages[$brand['brand']] ?? 'img/o0.jpg'; ?>
            <a href="<?= e(url('shop?brand=' . rawurlencode($brand['brand']))); ?>">
                <img src="<?= e(safe_image($brandImage)); ?>" alt="">
                <span><?= e(strtoupper($brand['brand'])); ?></span>
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
