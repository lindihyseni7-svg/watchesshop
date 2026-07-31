<?php // Filterable and paginated product catalog. ?>
<section class="page-hero compact catalog-hero">
    <div class="catalog-hero-media" aria-hidden="true">
        <img src="<?= e(safe_image('img/ora4.jpg')); ?>" alt="">
        <img src="<?= e(safe_image('img/o0.jpg')); ?>" alt="">
    </div>
    <div class="catalog-hero-copy">
        <span class="kicker">Katalogu</span>
        <h1>Gjeje oren tende</h1>
        <p><?= (int) $catalog['total']; ?> modele te kuruara, nga ikonat klasike te sportivet moderne.</p>
    </div>
</section>

<section class="catalog-layout">
    <aside class="filter-sidebar" data-filter-panel>
        <div class="filter-heading">
            <h2>Filtro</h2>
            <button class="icon-button filter-close" type="button" data-filter-close aria-label="Mbyll filtrat"><i data-lucide="x"></i></button>
        </div>
        <form method="get" action="<?= e(url('shop')); ?>">
            <div class="filter-group">
                <label for="catalog-search">Kerko</label>
                <div class="search-input"><i data-lucide="search"></i><input id="catalog-search" type="search" name="search" value="<?= e($filters['search']); ?>" placeholder="Modeli, brendi..."></div>
            </div>

            <div class="filter-group">
                <label for="brand">Brendi</label>
                <select id="brand" name="brand">
                    <option value="">Te gjitha brendet</option>
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?= e($brand['brand']); ?>" <?= $filters['brand'] === $brand['brand'] ? 'selected' : ''; ?>>
                            <?= e($brand['brand']); ?> (<?= (int) $brand['total']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-group">
                <label>Intervali i cmimit</label>
                <div class="price-inputs">
                    <input type="number" name="min" value="<?= e($filters['min']); ?>" min="0" placeholder="Min">
                    <span>-</span>
                    <input type="number" name="max" value="<?= e($filters['max']); ?>" min="0" placeholder="Max">
                </div>
            </div>

            <label class="check-row"><input type="checkbox" name="discount" value="1" <?= $filters['discount'] ? 'checked' : ''; ?>><span>Vetem me zbritje</span></label>
            <label class="check-row"><input type="checkbox" name="in_stock" value="1" <?= $filters['in_stock'] ? 'checked' : ''; ?>><span>Ne stok</span></label>
            <input type="hidden" name="sort" value="<?= e($filters['sort']); ?>">

            <button class="button button-dark full" type="submit">Apliko filtrat</button>
            <a class="clear-filters" href="<?= e(url('shop')); ?>">Pastro te gjitha</a>
        </form>
    </aside>

    <div class="catalog-content">
        <div class="catalog-toolbar">
            <button class="button button-outline filter-open" type="button" data-filter-open><i data-lucide="sliders-horizontal"></i> Filtrat</button>
            <span><?= (int) $catalog['total']; ?> produkte</span>
            <form method="get" action="<?= e(url('shop')); ?>" class="sort-form">
                <?php foreach (['search', 'brand', 'min', 'max', 'discount', 'in_stock'] as $key): ?>
                    <?php if ($filters[$key] !== ''): ?><input type="hidden" name="<?= e($key); ?>" value="<?= e($filters[$key]); ?>"><?php endif; ?>
                <?php endforeach; ?>
                <label for="sort">Rendit sipas</label>
                <select id="sort" name="sort" data-auto-submit>
                    <option value="newest" <?= $filters['sort'] === 'newest' ? 'selected' : ''; ?>>New in</option>
                    <option value="popular" <?= $filters['sort'] === 'popular' ? 'selected' : ''; ?>>Me te kerkuarat</option>
                    <option value="discount_desc" <?= $filters['sort'] === 'discount_desc' ? 'selected' : ''; ?>>Zbritja me e madhe</option>
                    <option value="price_asc" <?= $filters['sort'] === 'price_asc' ? 'selected' : ''; ?>>Cmimi: ulet ne larte</option>
                    <option value="price_desc" <?= $filters['sort'] === 'price_desc' ? 'selected' : ''; ?>>Cmimi: larte ne ulet</option>
                    <option value="brand_asc" <?= $filters['sort'] === 'brand_asc' ? 'selected' : ''; ?>>Brendi: A-Z</option>
                    <option value="brand_desc" <?= $filters['sort'] === 'brand_desc' ? 'selected' : ''; ?>>Brendi: Z-A</option>
                </select>
            </form>
        </div>

        <?php if ($catalog['items']): ?>
            <div class="product-grid catalog-grid">
                <?php foreach ($catalog['items'] as $product) require VIEW_PATH . '/components/product-card.php'; ?>
            </div>

            <?php if ($catalog['pages'] > 1): ?>
                <nav class="pagination" aria-label="Faqet">
                    <?php for ($page = 1; $page <= $catalog['pages']; $page++): ?>
                        <?php $query = array_merge($filters, ['page' => $page]); ?>
                        <a class="<?= $page === $catalog['page'] ? 'active' : ''; ?>" href="<?= e(url('shop?' . http_build_query($query))); ?>"><?= $page; ?></a>
                    <?php endfor; ?>
                </nav>
            <?php endif; ?>
        <?php else: ?>
            <div class="empty-state">
                <i data-lucide="search-x"></i>
                <h2>Nuk gjetem nje perputhje</h2>
                <p>Provo nje brend tjeter ose zgjero intervalin e cmimit.</p>
                <a class="button button-dark" href="<?= e(url('shop')); ?>">Pastro filtrat</a>
            </div>
        <?php endif; ?>
    </div>
</section>
