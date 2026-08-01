<?php
// Searchable, categorized FAQ using accessible native details elements.
$faqGroups = [
    'Produkte dhe autenticitet' => [
        ['A jane oret autentike?', 'Po. Secila ore kontrollohet per reference, numer serie, gjendje dhe dokumentacion para listimit dhe para dorezimit.'],
        ['A jane fotografite te produktit real?', 'Fotografite e produktit dhe pershkrimi tregojne konfigurimin e listes. Per nje blerje konkrete mund te kerkosh foto shtese dhe konfirmim te gjendjes.'],
        ['Cfare perfshihet me oren?', 'Kutia, dokumentet, garancia dhe aksesoret ndryshojne sipas references. Cdo element i perfshire konfirmohet ne faqen e produktit ose para porosise.'],
    ],
    'Porosia dhe transporti' => [
        ['Sa zgjat transporti?', 'Porosite brenda Kosoves zakonisht dorezohen brenda 1-3 diteve te punes. Afati konfirmohet para dergeses dhe varet nga lokacioni.'],
        ['A mund ta rezervoj nje ore?', 'Po. Na kontakto me referencen e produktit. Rezervimi konfirmohet vetem pasi stoku dhe kushtet te verifikohen nga ekipi.'],
        ['Si paketohet porosia?', 'Ora paketohet ne menyre te sigurt, me mbrojtje ndaj levizjes dhe goditjeve. Per modele me vlere te larte perdoret dergese e gjurmueshme.'],
    ],
    'Pagesa dhe kthimi' => [
        ['Cilat menyra pagese pranohen?', 'Ne kete faze porosia konfirmohet direkt me ekipin. Menyra e pageses dhe detajet bankare komunikohen vetem gjate procesit te sigurt te porosise.'],
        ['A mund ta kthej produktin?', 'Kthimi pranohet brenda 14 diteve nese ora mbetet ne gjendjen e dorezuar, pa shenja perdorimi dhe me paketimin e dokumentet perkatese.'],
        ['Si funksionon rimbursimi?', 'Pas pranimit dhe kontrollit te produktit, rimbursimi kryhet me metoden e dakorduar. Koha bankare e procesimit mund te ndryshoje.'],
    ],
    'Servisi dhe garancia' => [
        ['Si funksionon garancia?', 'Garancia varet nga modeli, prodhuesi dhe gjendja e produktit. Afati dhe mbulimi konfirmohen ne dokumentet qe shoqerojne oren.'],
        ['Kur duhet servisuar nje ore automatike?', 'Intervali varet nga mekanizmi dhe perdorimi. Nje kontroll cdo disa vite dhe test periodik i rezistences ne uje jane praktike e mire.'],
        ['A ndihmoni me zgjedhjen e modelit?', 'Po. Mund te te udhezojme sipas buxhetit, madhesise se dores, stilit dhe menyres si planifikon ta perdoresh oren.'],
    ],
];
?>

<section class="faq-hero">
    <div>
        <span class="kicker dark">Client services</span>
        <h1>Si mund te ndihmojme?</h1>
        <p>Kerko nje pergjigje ose shfleto temat me te zakonshme per produktet, porosite dhe kujdesin e ores.</p>
        <label class="faq-search" for="faq-search-input">
            <i data-lucide="search"></i>
            <span class="sr-only">Kerko ne pyetjet e shpeshta</span>
            <input id="faq-search-input" type="search" placeholder="Kerko: garancia, kthimi, transporti..." data-faq-search>
        </label>
    </div>
</section>

<section class="faq-layout modern-faq">
    <aside class="faq-support">
        <span class="kicker dark">Ndihme personale</span>
        <h2>Nuk e gjete pergjigjen?</h2>
        <p>Na shkruaj modelin ose pyetjen tende dhe ekipi do te pergjigjet me informacion konkret.</p>
        <a class="button button-dark full" href="<?= e(url('contact')); ?>">Na kontakto <i data-lucide="arrow-right"></i></a>
        <a class="text-link" href="<?= e(url('sell-watch')); ?>">Deshiron te shesesh nje ore?</a>
    </aside>

    <div class="faq-groups">
        <?php foreach ($faqGroups as $group => $faqs): ?>
            <section class="faq-group">
                <div class="faq-group-heading"><span><?= e(str_pad((string) (array_search($group, array_keys($faqGroups), true) + 1), 2, '0', STR_PAD_LEFT)); ?></span><h2><?= e($group); ?></h2></div>
                <div class="faq-list">
                    <?php foreach ($faqs as [$question, $answer]): ?>
                        <details data-faq-item>
                            <summary><?= e($question); ?><i data-lucide="plus"></i></summary>
                            <p><?= e($answer); ?></p>
                        </details>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
        <div class="faq-empty" data-faq-empty hidden><i data-lucide="search-x"></i><h2>Nuk gjetem perputhje</h2><p>Provo nje fjale me te shkurter ose na kontakto direkt.</p></div>
    </div>
</section>
