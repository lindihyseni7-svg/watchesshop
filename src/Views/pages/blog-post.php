<?php // Individual long-form article view. ?>
<article class="blog-article">
    <header class="article-header">
        <a class="text-link" href="<?= e(url('blog')); ?>"><i data-lucide="arrow-left"></i> Kthehu te blogu</a>
        <div class="article-meta"><span><?= e($post['category']); ?></span><span><?= e($post['date']); ?></span><span><?= e($post['read_time']); ?></span></div>
        <h1><?= e($post['title']); ?></h1>
        <p><?= e($post['intro']); ?></p>
    </header>

    <figure class="article-cover">
        <img src="<?= e(safe_image($post['image'])); ?>" alt="<?= e($post['title']); ?>">
    </figure>

    <div class="article-layout">
        <div class="article-body">
            <?php foreach ($post['sections'] as [$heading, $content]): ?>
                <section>
                    <h2><?= e($heading); ?></h2>
                    <p><?= e($content); ?></p>
                </section>
            <?php endforeach; ?>
            <aside class="article-note">
                <i data-lucide="info"></i>
                <p>Specifikimet dhe intervalet e servisit ndryshojne sipas references. Kontrollo gjithmone dokumentacionin e modelit konkret.</p>
            </aside>
        </div>

        <aside class="article-sidebar">
            <span class="kicker dark">Watches Prishtina</span>
            <h2>Po kerkon modelin e duhur?</h2>
            <p>Krahaso koleksionin sipas brendit, cmimit dhe stilit.</p>
            <a class="button button-dark full" href="<?= e(url('shop')); ?>">Shiko koleksionin</a>
            <a class="button button-outline full" href="<?= e(url('contact')); ?>">Na pyet</a>
        </aside>
    </div>
</article>

<section class="related-articles">
    <div class="section-title-row"><h2>Vazhdo leximin</h2><a class="text-link" href="<?= e(url('blog')); ?>">Te gjithe artikujt <i data-lucide="arrow-right"></i></a></div>
    <div class="article-grid compact">
        <?php foreach (array_slice($relatedPosts, 0, 3) as $related): ?>
            <article class="article-card">
                <a class="article-card-media" href="<?= e(url('blog/' . $related['slug'])); ?>"><img src="<?= e(safe_image($related['image'])); ?>" alt="<?= e($related['title']); ?>" loading="lazy"></a>
                <div class="article-meta"><span><?= e($related['category']); ?></span><span><?= e($related['read_time']); ?></span></div>
                <h2><a href="<?= e(url('blog/' . $related['slug'])); ?>"><?= e($related['title']); ?></a></h2>
            </article>
        <?php endforeach; ?>
    </div>
</section>
