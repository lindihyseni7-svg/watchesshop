<?php
// Brand story and service values.
$storyImage = is_file(ROOT_PATH . '/img/pikat.jpg') ? 'img/pikat.jpg' : 'img/section2.jpg';
?>
<section class="story-hero">
    <img src="<?= e(url($storyImage)); ?>" alt="Koleksioni Watches Prishtina">
    <div><span class="kicker">Qe nga Prishtina</span><h1>Ora e duhur behet pjese e historise tende.</h1></div>
</section>

<section class="story-copy">
    <div><span class="kicker dark">Rreth nesh</span><h2>Shije e qarte. Zgjedhje me arsye.</h2></div>
    <div>
        <p>Watches Prishtina lindi nga nje bindje e thjeshte: blerja e nje ore duhet te jete po aq e kujdesshme sa vete mekanizmi i saj.</p>
        <p>Ne kurojme nje koleksion qe lidh ikonat e njohura me modele moderne me vlere reale. Çdo reference zgjidhet per dizajnin, historine, materialet dhe menyren si ndihet ne dore.</p>
    </div>
</section>

<section class="values-grid">
    <article><span>01</span><h3>Autenticitet</h3><p>Kontroll i produktit, references dhe gjendjes para dorezimit.</p></article>
    <article><span>02</span><h3>Keshillim</h3><p>Nuk shesim vetem modelin me te shtrenjte. Gjejme modelin e duhur per ty.</p></article>
    <article><span>03</span><h3>Kujdes pas blerjes</h3><p>Qendrojme ne dispozicion edhe pasi ora behet e jotja.</p></article>
</section>

<section class="service-strip">
    <article><i data-lucide="map-pin"></i><div><strong>Prishtine</strong><span>Keshillim lokal dhe i afert</span></div></article>
    <article><i data-lucide="badge-check"></i><div><strong>Produkte te zgjedhura</strong><span>Katalog me standard te qarte</span></div></article>
    <article><i data-lucide="messages-square"></i><div><strong>Komunikim real</strong><span>Pa presion, pa komplikime</span></div></article>
    <article><i data-lucide="watch"></i><div><strong>Pasion per oren</strong><span>Detajet kane rendesi</span></div></article>
</section>
