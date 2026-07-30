<?php
include 'inc/header.php';

$filters = [
    'search' => $_GET['search'] ?? '',
    'brand' => $_GET['brand'] ?? '',
    'min' => $_GET['min'] ?? '',
    'max' => $_GET['max'] ?? '',
    'sort' => $_GET['sort'] ?? 'newest',
    'page' => $_GET['page'] ?? 1,
    'per_page' => 8
];

$catalog = merrOretKatalog($filters);
$brands = merrEmratOreve();

function pageUrl($page, $filters){
    $query = $filters;
    $query['page'] = $page;
    return 'orat.php?' . http_build_query(array_filter($query, function($value){
        return $value !== '' && $value !== null;
    }));
}
?>

<section class="catalog-hero container">
    <p class="eyebrow">Katalogu</p>
    <h1>Gjej oren sipas emrit, cmimit dhe renditjes.</h1>
</section>

<section class="container panel filters-panel">
    <form class="filters-form" method="get" action="orat.php">
        <div class="field">
            <label for="search">Kerko</label>
            <input type="search" id="search" name="search" placeholder="Rolex, Seiko, modeli..." value="<?= e($filters['search']); ?>">
        </div>
        <div class="field">
            <label for="brand">Brendi</label>
            <select id="brand" name="brand">
                <option value="">Te gjitha</option>
                <?php while($brand = mysqli_fetch_assoc($brands)): ?>
                    <option value="<?= e($brand['emri']); ?>" <?= $filters['brand'] === $brand['emri'] ? 'selected' : ''; ?>>
                        <?= e($brand['emri']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="field">
            <label for="min">Min $</label>
            <input type="number" id="min" name="min" min="0" value="<?= e($filters['min']); ?>">
        </div>
        <div class="field">
            <label for="max">Max $</label>
            <input type="number" id="max" name="max" min="0" value="<?= e($filters['max']); ?>">
        </div>
        <div class="field">
            <label for="sort">Rendit</label>
            <select id="sort" name="sort">
                <option value="newest" <?= $filters['sort'] === 'newest' ? 'selected' : ''; ?>>Me te rejat</option>
                <option value="price_asc" <?= $filters['sort'] === 'price_asc' ? 'selected' : ''; ?>>Cmimi i ulet</option>
                <option value="price_desc" <?= $filters['sort'] === 'price_desc' ? 'selected' : ''; ?>>Cmimi i larte</option>
                <option value="name_asc" <?= $filters['sort'] === 'name_asc' ? 'selected' : ''; ?>>A-Z</option>
            </select>
        </div>
        <button class="button" type="submit"><i class="mdi mdi-filter-outline"></i> Filtro</button>
    </form>
</section>

<main class="container section-pad" style="padding-top:18px;">
    <div class="catalog-toolbar">
        <span><?= $catalog['total']; ?> produkte u gjeten</span>
        <?php if($filters['search'] || $filters['brand'] || $filters['min'] || $filters['max']): ?>
            <a href="orat.php">Pastro filtrat</a>
        <?php endif; ?>
    </div>

    <?php if($catalog['total'] > 0): ?>
        <div class="product-grid">
            <?php
            $i = (($catalog['page'] - 1) * $catalog['per_page']);
            while($ora = mysqli_fetch_assoc($catalog['result'])):
                $image = watchImage($i);
                $i++;
            ?>
                <article class="product-card">
                    <img src="<?= e($image); ?>" alt="<?= e($ora['emri']); ?>">
                    <div class="product-card-body">
                        <div class="product-meta">
                            <span><?= e($ora['modeli']); ?></span>
                            <span>#<?= e($ora['id']); ?></span>
                        </div>
                        <h3><?= e($ora['emri']); ?></h3>
                        <div class="price">$<?= money($ora['cmimi']); ?></div>
                        <form class="add-to-cart-form" method="post" action="shto_ne_shporte.php">
                            <input type="hidden" name="oraid" value="<?= e($ora['id']); ?>">
                            <input type="hidden" name="emri" value="<?= e($ora['emri']); ?>">
                            <input type="hidden" name="modeli" value="<?= e($ora['modeli']); ?>">
                            <input type="hidden" name="cmimi" value="<?= e($ora['cmimi']); ?>">
                            <div class="quantity-row">
                                <label for="sasia-<?= e($ora['id']); ?>">Sasia</label>
                                <input id="sasia-<?= e($ora['id']); ?>" type="number" name="sasia" class="quantity-input" value="1" min="1">
                            </div>
                            <button type="submit" class="add-to-cart-btn"><i class="mdi mdi-cart-plus"></i> Shto ne shporte</button>
                        </form>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <?php if($catalog['pages'] > 1): ?>
            <nav class="pagination" aria-label="Faqet e katalogut">
                <?php if($catalog['page'] > 1): ?>
                    <a href="<?= e(pageUrl($catalog['page'] - 1, $filters)); ?>">&lsaquo;</a>
                <?php endif; ?>

                <?php for($page = 1; $page <= $catalog['pages']; $page++): ?>
                    <?php if($page === $catalog['page']): ?>
                        <span class="current"><?= $page; ?></span>
                    <?php else: ?>
                        <a href="<?= e(pageUrl($page, $filters)); ?>"><?= $page; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if($catalog['page'] < $catalog['pages']): ?>
                    <a href="<?= e(pageUrl($catalog['page'] + 1, $filters)); ?>">&rsaquo;</a>
                <?php endif; ?>
            </nav>
        <?php endif; ?>
    <?php else: ?>
        <div class="panel empty-state">
            <h2>Nuk u gjet asnje produkt</h2>
            <p>Provo te ndryshosh kerkimin, brendin ose intervalin e cmimit.</p>
            <a class="button" href="orat.php">Kthehu te katalogu</a>
        </div>
    <?php endif; ?>
</main>

<?php include "inc/footer.php"; ?>
