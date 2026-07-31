<?php
// Public registration always creates a customer role.
$old = $old ?? [];
$errors = $errors ?? [];
?>
<section class="auth-shell">
    <div class="auth-visual register-visual">
        <img src="<?= e(safe_image('img/section2.jpg')); ?>" alt="Dyqani Watches Prishtina">
        <div><span class="kicker">Anetaresohu</span><h1>Koleksioni yt fillon ketu.</h1></div>
    </div>
    <div class="auth-form-panel">
        <a class="wordmark" href="<?= e(url()); ?>"><span class="wordmark-symbol">W</span><span>WATCHES <small>PRISHTINA</small></span></a>
        <form method="post" action="<?= e(url('register')); ?>" class="account-form register-form">
            <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
            <div><span class="kicker dark">Llogari klienti</span><h2>Regjistrohu</h2><p>Ruaj preferencat dhe menaxho porosite e ardhshme.</p></div>
            <div class="form-row">
                <label>Emri<input type="text" name="first_name" value="<?= e($old['first_name'] ?? ''); ?>" required><?php if (isset($errors['first_name'])): ?><small><?= e($errors['first_name']); ?></small><?php endif; ?></label>
                <label>Mbiemri<input type="text" name="last_name" value="<?= e($old['last_name'] ?? ''); ?>" required><?php if (isset($errors['last_name'])): ?><small><?= e($errors['last_name']); ?></small><?php endif; ?></label>
            </div>
            <label>Email<input type="email" name="email" value="<?= e($old['email'] ?? ''); ?>" autocomplete="email" required><?php if (isset($errors['email'])): ?><small><?= e($errors['email']); ?></small><?php endif; ?></label>
            <div class="form-row">
                <label>Telefoni<input type="tel" name="phone" value="<?= e($old['phone'] ?? ''); ?>"></label>
                <label>Numri personal<input type="text" name="personal_number" value="<?= e($old['personal_number'] ?? ''); ?>"></label>
            </div>
            <div class="form-row">
                <label>Fjalekalimi<input type="password" name="password" autocomplete="new-password" minlength="8" required><?php if (isset($errors['password'])): ?><small><?= e($errors['password']); ?></small><?php endif; ?></label>
                <label>Perserite<input type="password" name="password_confirmation" autocomplete="new-password" minlength="8" required><?php if (isset($errors['password_confirmation'])): ?><small><?= e($errors['password_confirmation']); ?></small><?php endif; ?></label>
            </div>
            <button class="button button-dark full" type="submit">Krijo llogarine <i data-lucide="arrow-right"></i></button>
            <p class="form-switch">Ke llogari? <a href="<?= e(url('login')); ?>">Kycu</a></p>
        </form>
    </div>
</section>
