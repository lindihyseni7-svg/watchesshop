<?php
// Login page for customer and administrator accounts.
$old = $old ?? [];
?>
<section class="auth-shell">
    <div class="auth-visual">
        <img src="<?= e(asset('images/hero-watches.png')); ?>" alt="Koleksioni Watches Prishtina">
        <div><span class="kicker">Watches Prishtina</span><h1>Mire se u ktheve.</h1></div>
    </div>
    <div class="auth-form-panel">
        <a class="wordmark" href="<?= e(url()); ?>"><span class="wordmark-symbol">W</span><span>WATCHES <small>PRISHTINA</small></span></a>
        <form method="post" action="<?= e(url('login')); ?>" class="account-form">
            <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
            <div>
                <span class="kicker dark">Llogaria</span>
                <h2>Kycu</h2>
                <p>Perdoruesit vazhdojne ne dyqan, administratoret ne panel.</p>
            </div>
            <?php if (!empty($error)): ?><div class="form-alert error"><?= e($error); ?></div><?php endif; ?>
            <label>Email<input type="email" name="email" value="<?= e($old['email'] ?? ''); ?>" autocomplete="email" required></label>
            <label>Fjalekalimi<input type="password" name="password" autocomplete="current-password" required></label>
            <button class="button button-dark full" type="submit">Kycu <i data-lucide="arrow-right"></i></button>
            <div class="demo-login-card">
                <span>Demo admin read-only</span>
                <strong>demo.admin@watchesshop.test</strong>
                <small>Password: DemoAdmin2026!</small>
            </div>
            <p class="form-switch">Nuk ke llogari? <a href="<?= e(url('register')); ?>">Regjistrohu</a></p>
        </form>
    </div>
</section>
