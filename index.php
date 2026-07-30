<?php
include 'inc/header.php';

$stats = merrStatistikaKatalogu();
$featured = merrOretKatalog(['per_page' => 8, 'sort' => 'newest']);
$brandImages = ['img/o0.jpg', 'img/a2.jpg', 'img/a3.jpg', 'img/a4.jpg'];
$brandNames = ['Seiko', 'Rolex', 'Jacob & Co', 'Richard Mille'];
?>

<section class="hero">
    <div class="container hero-content">
        <p class="eyebrow">Premium watch store</p>
        <h1>Watches Prishtina</h1>
        <p>Katalog modern per ore premium, brende te njohura, oferta aktive dhe shporte te thjeshte per porosi online.</p>
        <div class="hero-actions">
            <a class="button" href="orat.php"><i class="mdi mdi-watch-variant"></i> Shfleto orat</a>
            <a class="button secondary" href="orat.php?sort=price_asc"><i class="mdi mdi-tag-outline"></i> Gjej oferta</a>
        </div>
    </div>
</section>

<section class="container stats-grid">
    <article class="stat-card">
        <strong><?= $stats['produkte']; ?></strong>
        <span>Produkte ne katalog</span>
    </article>
    <article class="stat-card">
        <strong><?= $stats['brende']; ?></strong>
        <span>Brende te ndryshme</span>
    </article>
    <article class="stat-card">
        <strong>$<?= money($stats['min_cmimi']); ?>+</strong>
        <span>Cmimi fillestar</span>
    </article>
</section>

<section class="section-pad">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="eyebrow">Koleksioni</p>
                <h2>Modelet me te fundit</h2>
                <p>Zgjedhje te shpejta nga databaza, me imazhe lokale dhe veprim direkt per shporte.</p>
            </div>
            <a class="button secondary" href="orat.php">Shiko katalogun</a>
        </div>

        <div class="product-grid">
            <?php
            $i = 0;
            while($ora = mysqli_fetch_assoc($featured['result'])):
                $image = watchImage($i);
                $i++;
            ?>
                <article class="product-card">
                    <img src="<?= e($image); ?>" alt="<?= e($ora['emri']); ?>">
                    <div class="product-card-body">
                        <div class="product-meta">
                            <span><?= e($ora['modeli']); ?></span>
                            <span>ID <?= e($ora['id']); ?></span>
                        </div>
                        <h3><?= e($ora['emri']); ?></h3>
                        <div class="price">$<?= money($ora['cmimi']); ?></div>
                        <form class="add-to-cart-form" method="post" action="shto_ne_shporte.php">
                            <input type="hidden" name="oraid" value="<?= e($ora['id']); ?>">
                            <input type="hidden" name="emri" value="<?= e($ora['emri']); ?>">
                            <input type="hidden" name="modeli" value="<?= e($ora['modeli']); ?>">
                            <input type="hidden" name="cmimi" value="<?= e($ora['cmimi']); ?>">
                            <button type="submit" class="add-to-cart-btn"><i class="mdi mdi-cart-plus"></i> Shto ne shporte</button>
                        </form>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<section class="section-pad" style="background:#f4f6f8;">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="eyebrow">Brendet</p>
                <h2>Stile per cdo rast</h2>
            </div>
            <?php if(isAdmin()): ?>
                <a class="button secondary" href="brendet.php">Menaxho brendet</a>
            <?php endif; ?>
        </div>

        <div class="brand-grid">
            <?php foreach($brandNames as $index => $brand): ?>
                <article class="brand-card">
                    <img src="<?= e($brandImages[$index]); ?>" alt="<?= e($brand); ?>">
                    <div>
                        <h3><?= e($brand); ?></h3>
                        <p>Koleksion i zgjedhur me modele elegante dhe sportive.</p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container split-section">
        <img src="img/oferta.jpg" alt="Ofertat e orave">
        <div>
            <p class="eyebrow">Oferta speciale</p>
            <h2>Ulje te menaxhueshme nga admini</h2>
            <p>Paneli i ofertave ruan emrin, zbritjen dhe datat aktive, ndersa klientet kane hyrje te shpejte ne koleksion dhe shporte.</p>
            <div class="hero-actions">
                <a class="button" href="orat.php?sort=price_asc"><i class="mdi mdi-sale-outline"></i> Gjej cmimin me te mire</a>
                <a class="button secondary" href="shporta.php"><i class="mdi mdi-cart-outline"></i> Shporta</a>
            </div>
        </div>
    </div>
</section>

<?php include 'inc/footer.php'; ?>
