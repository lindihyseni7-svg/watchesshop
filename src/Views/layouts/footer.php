<?php // Shared footer, support links, newsletter form and global toast target. ?>
</main>

<footer class="store-footer">
    <div class="footer-main">
        <div class="footer-intro">
            <a class="wordmark footer-wordmark" href="<?= e(url()); ?>">
                <span class="wordmark-symbol">W</span>
                <span>WATCHES <small>PRISHTINA</small></span>
            </a>
            <p>Koha e mire nuk matet vetem. Ajo zgjidhet me kujdes.</p>
            <div class="social-row">
                <a href="#" class="icon-button" aria-label="Instagram"><i data-lucide="instagram"></i></a>
                <a href="#" class="icon-button" aria-label="Facebook"><i data-lucide="facebook"></i></a>
                <a href="#" class="icon-button" aria-label="Youtube"><i data-lucide="youtube"></i></a>
            </div>
        </div>

        <div class="footer-column">
            <h3>Koleksioni</h3>
            <a href="<?= e(url('shop?sort=newest')); ?>">New in</a>
            <a href="<?= e(url('shop?sort=popular')); ?>">Me te kerkuarat</a>
            <a href="<?= e(url('shop?discount=1&sort=discount_desc')); ?>">Me zbritje</a>
            <a href="<?= e(url('favorites')); ?>">Lista e deshirave</a>
        </div>

        <div class="footer-column">
            <h3>Watches Prishtina</h3>
            <a href="<?= e(url('about')); ?>">Rreth nesh</a>
            <a href="<?= e(url('contact')); ?>">Na kontakto</a>
            <a href="<?= e(url('faq')); ?>">Pyetje te shpeshta</a>
            <a href="<?= e(url('login')); ?>">Llogaria ime</a>
        </div>

        <div class="footer-column newsletter">
            <h3>Koha per lajme te mira</h3>
            <p>Koleksione te reja dhe oferta private, direkt ne email.</p>
            <form class="newsletter-form" method="post" action="<?= e(url('newsletter')); ?>" data-newsletter-form>
                <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
                <label class="sr-only" for="newsletter-email">Email</label>
                <input id="newsletter-email" name="email" type="email" placeholder="Email adresa" required>
                <button class="icon-button" type="submit" aria-label="Regjistrohu"><i data-lucide="arrow-right"></i></button>
            </form>
        </div>
    </div>

    <div class="footer-bottom">
        <span>&copy; <?= date('Y'); ?> Watches Prishtina</span>
        <span>Prishtine, Kosove</span>
        <div class="payment-marks"><span>VISA</span><span>Mastercard</span><span>PayPal</span></div>
    </div>
</footer>

<div class="toast" data-toast role="status" aria-live="polite"></div>
</body>
</html>
