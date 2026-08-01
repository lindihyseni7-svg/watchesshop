<?php // Professional valuation page using the existing contact API. ?>
<section class="sell-hero">
    <img src="<?= e(safe_image('img/koleksioni-page.jpg')); ?>" alt="Koleksion orash vintage per vleresim">
    <div class="sell-hero-copy">
        <span class="kicker">Private valuation</span>
        <h1>Shit oren tende.</h1>
        <p>Merr nje vleresim te qarte dhe konkurrues nga ekipi yne, pa presion dhe pa detyrim per ta shitur.</p>
        <a class="button button-light" href="#valuation-form">Kerko vleresim <i data-lucide="arrow-down"></i></a>
    </div>
</section>

<section class="valuation-benefits" aria-label="Avantazhet e vleresimit">
    <div><i data-lucide="badge-check"></i><span>Vleresim nga eksperte</span></div>
    <div><i data-lucide="scale"></i><span>Oferte e argumentuar</span></div>
    <div><i data-lucide="lock-keyhole"></i><span>Proces privat dhe i sigurt</span></div>
</section>

<section class="sell-process">
    <div class="process-column">
        <span class="kicker dark">Si funksionon</span>
        <h2>Kater hapa, pa paqartesi.</h2>
        <ol class="process-list">
            <li><span>01</span><div><h3>Dergo detajet</h3><p>Na trego brendin, referencen, vitin, gjendjen dhe cfare perfshihet me oren.</p></div></li>
            <li><span>02</span><div><h3>Merr vleresimin fillestar</h3><p>Ekipi krahason modelin, tregun, gjendjen dhe historikun e servisit per nje interval realist.</p></div></li>
            <li><span>03</span><div><h3>Kontrolli fizik</h3><p>Nese vleresimi te pershtatet, caktojme kontrollin e ores dhe verifikimin e autenticitetit.</p></div></li>
            <li><span>04</span><div><h3>Oferta dhe pagesa</h3><p>Pas verifikimit merr oferten finale. Vendimi mbetet i yti dhe pagesa kryhet ne menyren e dakorduar.</p></div></li>
        </ol>
    </div>

    <aside class="expert-panel">
        <span class="kicker dark">Expert knowledge</span>
        <h2>Nje vleresim i mire shpjegohet.</h2>
        <p>Ne marrim parasysh referencen, kerkesen ne treg, gjendjen estetike, mekanizmin, dokumentet dhe historikun e servisit.</p>
        <ul class="check-list">
            <li><i data-lucide="check"></i> Pa tarife per vleresimin fillestar</li>
            <li><i data-lucide="check"></i> Pa detyrim per ta pranuar oferten</li>
            <li><i data-lucide="check"></i> Komunikim direkt dhe konfidencial</li>
        </ul>
        <div class="brands-we-buy"><span>Brendet qe konsiderojme</span><p>Rolex, Tudor, Omega, Cartier, Breitling, IWC, Panerai, TAG Heuer, Zenith, Longines, Seiko dhe modele te tjera me interes.</p></div>
    </aside>
</section>

<section class="valuation-section" id="valuation-form">
    <div class="valuation-intro">
        <span class="kicker dark">Get your valuation</span>
        <h2>Na trego per oren.</h2>
        <p>Sa me te sakta te jene te dhenat, aq me i dobishem do te jete vleresimi fillestar. Pergjigjja dergohet ne emailin qe vendos me poshte.</p>
        <div class="valuation-contact"><i data-lucide="clock-3"></i><span><strong>Pergjigje brenda 1 dite pune</strong>Vleresimi final kerkon kontroll fizik.</span></div>
    </div>

    <form class="contact-form valuation-form" method="post" action="<?= e(url('contact')); ?>" data-contact-form data-valuation-form>
        <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
        <input type="hidden" name="subject" value="Kerkese per vleresim ore">
        <div class="form-row">
            <label>Emri dhe mbiemri<input type="text" name="name" autocomplete="name" required></label>
            <label>Email<input type="email" name="email" autocomplete="email" required></label>
        </div>
        <div class="form-row">
            <label>Telefoni<input type="tel" name="phone" autocomplete="tel" placeholder="+383 ..."></label>
            <label>Brendi<input type="text" name="watch_brand" placeholder="p.sh. Rolex" required></label>
        </div>
        <div class="form-row">
            <label>Modeli / referenca<input type="text" name="watch_reference" placeholder="p.sh. 116610" required></label>
            <label>Viti i perafert<input type="number" name="watch_year" min="1900" max="2026" placeholder="2020"></label>
        </div>
        <div class="form-row">
            <label>Gjendja<select name="condition" required><option value="">Zgjidh gjendjen</option><option>Si e re</option><option>Shume e mire</option><option>E mire</option><option>Ka shenja perdorimi</option><option>Kerkohet servis</option></select></label>
            <label>Cfare perfshihet?<select name="included"><option>Vetem ora</option><option>Ora dhe kutia</option><option>Full set: kuti dhe dokumente</option></select></label>
        </div>
        <label>Link me fotografi<input type="url" name="image_link" placeholder="Google Drive, Dropbox ose link tjeter"></label>
        <label>Detaje shtese<textarea name="notes" rows="5" placeholder="Servisi i fundit, demtime, aksesore ose informacion tjeter..."></textarea></label>
        <label class="valuation-consent"><input type="checkbox" required><span>Konfirmoj se informacioni eshte i sakte dhe pranoj te kontaktohem per kete vleresim.</span></label>
        <button class="button button-dark" type="submit">Dergo per vleresim <i data-lucide="arrow-right"></i></button>
    </form>
</section>
