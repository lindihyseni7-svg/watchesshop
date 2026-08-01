<?php
// Editorial watch journal backed by the local BlogCatalog content source.
$featuredPost = $posts[0] ?? null;
$remainingPosts = array_slice($posts, 1);
?>

<section class="blog-hero">
    <img src="<?= e(safe_image('img/showcase-section.jpg')); ?>" alt="Koleksion orash ne nje vitrine klasike">
    <div>
        <span class="kicker">The Watch Journal</span>
        <h1>Njohuri qe e bejne zgjedhjen me te mire.</h1>
        <p>Udhezues praktik, histori brendesh dhe shpjegime teknike per njerez qe duan ta kuptojne oren para se ta blejne.</p>
    </div>
</section>

<?php if ($featuredPost): ?>
<section class="blog-feature">
    <a class="blog-feature-media" href="<?= e(url('blog/' . $featuredPost['slug'])); ?>">
        <img src="<?= e(safe_image($featuredPost['image'])); ?>" alt="<?= e($featuredPost['title']); ?>">
    </a>
    <div class="blog-feature-copy">
        <div class="article-meta"><span><?= e($featuredPost['category']); ?></span><span><?= e($featuredPost['date']); ?></span><span><?= e($featuredPost['read_time']); ?></span></div>
        <h2><a href="<?= e(url('blog/' . $featuredPost['slug'])); ?>"><?= e($featuredPost['title']); ?></a></h2>
        <p><?= e($featuredPost['excerpt']); ?></p>
        <a class="text-link" href="<?= e(url('blog/' . $featuredPost['slug'])); ?>">Lexo artikullin <i data-lucide="arrow-right"></i></a>
    </div>
</section>
<?php endif; ?>

<section class="blog-index">
    <div class="section-title-row">
        <div><span class="kicker dark">Artikujt e fundit</span><h2>Lexo, krahaso, vendos.</h2></div>
    </div>
    <div class="article-grid">
        <?php foreach ($remainingPosts as $post): ?>
            <article class="article-card">
                <a class="article-card-media" href="<?= e(url('blog/' . $post['slug'])); ?>">
                    <img src="<?= e(safe_image($post['image'])); ?>" alt="<?= e($post['title']); ?>" loading="lazy">
                </a>
                <div class="article-meta"><span><?= e($post['category']); ?></span><span><?= e($post['read_time']); ?></span></div>
                <h2><a href="<?= e(url('blog/' . $post['slug'])); ?>"><?= e($post['title']); ?></a></h2>
                <p><?= e($post['excerpt']); ?></p>
                <a class="article-link" href="<?= e(url('blog/' . $post['slug'])); ?>" aria-label="Lexo <?= e($post['title']); ?>"><span>Lexo me shume</span><i data-lucide="arrow-up-right"></i></a>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="journal-cta">
    <div><span class="kicker">Private notes</span><h2>Informohu para se te investosh.</h2></div>
    <p>Merr artikujt e rinj dhe udhezuesit e koleksionit direkt ne email.</p>
    <form class="newsletter-form journal-newsletter" method="post" action="<?= e(url('newsletter')); ?>" data-newsletter-form>
        <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
        <label class="sr-only" for="journal-email">Email</label>
        <input id="journal-email" name="email" type="email" placeholder="Email adresa" required>
        <button class="button button-light" type="submit">Regjistrohu <i data-lucide="arrow-right"></i></button>
    </form>
</section>
