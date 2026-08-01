<?php // Contact information and database-backed message form. ?>
<section class="contact-hero">
    <img src="<?= e(safe_image('img/kontakti.jpg', 'img/showcase-section.jpg')); ?>" alt="Kontakt me dyqanin Watches Prishtina">
    <div>
        <span class="kicker">Kontakti</span>
        <h1>Flasim per oren tende te ardhshme.</h1>
        <p>Pyetje per modelin, disponueshmerine apo dorezimin? Jemi ketu.</p>
        <a class="button button-light" href="#contact-form">Dergo mesazh <i data-lucide="send"></i></a>
    </div>
</section>

<section class="contact-layout">
    <div class="contact-details">
        <div><i data-lucide="map-pin"></i><span><strong>Vizita</strong>Prishtine, Kosove<br>E hene - E shtune, 09:00 - 18:00</span></div>
        <div><i data-lucide="phone"></i><span><strong>Telefoni</strong>+383 44 000 000</span></div>
        <div><i data-lucide="mail"></i><span><strong>Email</strong>hello@watchesprishtina.com</span></div>
        <p>Per nje pergjigje me te sakte, perfshije emrin ose referencen e ores qe po kerkon.</p>
    </div>

    <form id="contact-form" class="contact-form" method="post" action="<?= e(url('contact')); ?>" data-contact-form>
        <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
        <div class="form-row">
            <label>Emri<input type="text" name="name" required placeholder="Emri dhe mbiemri"></label>
            <label>Email<input type="email" name="email" required placeholder="email@example.com"></label>
        </div>
        <label>Subjekti<select name="subject" required><option value="">Zgjidh nje teme</option><option>Pyetje per produkt</option><option>Disponueshmeri</option><option>Dorezim dhe kthim</option><option>Tjeter</option></select></label>
        <label>Mesazhi<textarea name="message" rows="6" required minlength="10" placeholder="Si mund te ndihmojme?"></textarea></label>
        <button class="button button-dark" type="submit">Dergo mesazhin <i data-lucide="send"></i></button>
    </form>
</section>
