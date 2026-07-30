<?php // Frequently asked questions using accessible native details elements. ?>
<section class="page-hero compact light-hero">
    <span class="kicker dark">Ndihma</span>
    <h1>Pyetje te shpeshta</h1>
    <p>Pergjigje te qarta per produktet, transportin, pagesen dhe kthimet.</p>
</section>

<section class="faq-layout">
    <aside><h2>Ke pyetje tjeter?</h2><p>Na shkruaj dhe do te te pergjigjemi sa me shpejt.</p><a class="button button-dark" href="<?= e(url('contact')); ?>">Na kontakto</a></aside>
    <div class="faq-list">
        <?php
        $faqs = [
            ['A jane produktet autentike?', 'Po. Secila ore kontrollohet per reference, identitet dhe gjendje para se te listohet dhe para dorezimit.'],
            ['Sa zgjat transporti?', 'Porosite brenda Kosoves zakonisht dorezohen brenda 1-3 diteve te punes. Per lokacione tjera koha konfirmohet para pageses.'],
            ['A mund ta kthej nje produkt?', 'Po, kthimi pranohet brenda 14 diteve nese ora eshte ne gjendjen e dorezuar dhe me paketimin perkates.'],
            ['Si funksionon garancia?', 'Detajet e garancise varen nga modeli. Informacioni specifik konfirmohet ne faqen e produktit dhe dokumentet e dorezimit.'],
            ['A mund ta rezervoj nje ore?', 'Po. Na kontakto me referencen e produktit dhe do te kontrollojme mundesine e rezervimit.'],
            ['A ofroni keshillim para blerjes?', 'Po. Mund te te ndihmojme sipas buxhetit, stilit, madhesise dhe menyres se perdorimit.'],
        ];
        foreach ($faqs as $index => [$question, $answer]):
        ?>
            <details <?= $index === 0 ? 'open' : ''; ?>>
                <summary><?= e($question); ?><i data-lucide="plus"></i></summary>
                <p><?= e($answer); ?></p>
            </details>
        <?php endforeach; ?>
    </div>
</section>
