# Watches Prishtina

Watches Prishtina eshte nje platforme demo e-commerce per ora premium. Projekti eshte krijuar per te treguar si mund te duket dhe funksionoje nje dyqan modern online: me katalog dinamik, search, filtra, shporte, favorites, faqe produkti, faqe informuese dhe admin panel.

Ky nuk eshte vetem nje dizajn statik. Produktet, cmimet, zbritjet, stoku, brendet, kategorite, kontaktet, newsletter dhe paneli admin lidhen me databaze dhe funksionojne si nje sistem real demo.

## Teknologjite E Perdorura

Projekti eshte ndertuar me teknologji klasike web, pa framework te rende frontend:

- **PHP 8.2** per backend, controllers, services, repositories dhe rendering te faqeve.
- **MariaDB / MySQL** per databazen e produkteve, perdoruesve, porosive, kontakteve dhe admin panelit.
- **HTML5** per strukture semantike te faqeve.
- **CSS3** per dizajn responsive, layout, kartela produktesh, admin panel dhe animacione te lehta.
- **Vanilla JavaScript** per cart AJAX, favorites, menu mobile, filter UI, loading feedback dhe interactions.
- **Lucide Icons** per ikonat ne navbar, butona dhe UI controls.
- **Google Fonts / Manrope** per tipografi moderne dhe premium.
- **Apache / .htaccess** per clean URLs dhe routing pa file extensions.
- **Git** per versionim te projektit.

Arkitektura ndjek ndarje te qarte mes routes, controllers, repositories, services dhe views. Kjo e ben projektin me te organizuar dhe me te afert me menyren si ndertohen aplikacione reale.

## Eksperienca Per Vizitorin

Vizitori hyn ne balline dhe sheh nje storefront premium per ora. Ballina paraqet hero section, koleksione te zgjedhura, orat me te shitura, oferta, brende, seksione editoriale, materiale dhe pjese informuese per dyqanin.

Vizitori mund te:

- shfletoje koleksionin e orave
- kerkoje nga navbar-i me fjale kyce
- filtroje produktet sipas brendit
- filtroje sipas cmimit minimal dhe maksimal
- shfaqe vetem produktet me zbritje
- shfaqe vetem produktet ne stok
- rendise produktet sipas risive, popullaritetit, zbritjes, cmimit ose brendit
- kaloje neper faqe me pagination
- hape faqen individuale te cdo produkti
- ruaje produkte ne favorites
- shtoje produkte ne shporte
- ndryshoje sasine ne shporte
- dergoje pyetje nga forma e kontaktit
- regjistrohet ne newsletter
- lexoje artikuj ne blog
- shikoje FAQ
- shikoje faqen Sell Your Watch

## Search Dhe Katalogu

Search-i ne navbar eshte funksional dhe kerkon ne disa fusha te produktit, jo vetem ne emer.

Kerkimi mund te gjeje produkte sipas:

- emrit te ores
- modelit
- brendit
- pershkrimit
- historise se produktit
- mekanizmit
- materialit
- rezistences ndaj ujit
- slug-ut / fjaleve kyce ne URL

Kjo do te thote qe nje vizitor mund te kerkoje fjale si `Rolex`, `Diesel`, `Bugatti`, `automatic`, `stainless`, `red`, `diver` ose materiale dhe karakteristika te ngjashme.

## Produktet

Cdo produkt ka faqe individuale me informacion te qarte dhe te strukturuar.

Faqja e produktit shfaq:

- imazhin kryesor te ores
- brendin
- emrin dhe modelin
- cmimin aktual
- cmimin e vjeter kur ekziston zbritje reale
- statusin e stokut
- pershkrimin
- historine ose kontekstin e modelit
- mekanizmin
- materialin
- rezistencen ndaj ujit
- butonin per favorites
- butonin per shtim ne shporte
- produkte te ngjashme

Kartelat e produktit ne katalog shfaqin imazhin, brendin, emrin, modelin, cmimin, zbritjen, stokun, favorites dhe add-to-cart.

## Shporta Dhe Favorites

Shporta funksionon me AJAX, qe do te thote se vizitori mund te shtoje produkt pa refresh te plote te faqes.

Shporta lejon:

- shtim produkti
- ndryshim sasie
- heqje produkti
- shfaqje totali
- feedback vizual pas veprimit

Favorites lejon ruajtjen e produkteve te preferuara. Kjo e ben eksperiencen me reale, sepse vizitori mund te krijoje nje liste personale pa e futur produktin direkt ne shporte.

## API Dhe AJAX

Projekti perdor endpoints per veprime dinamike ne frontend.

API/AJAX perdoret per:

- shtim produkti ne shporte
- perditesim sasie ne shporte
- toggle favorites
- dergim mesazhi nga kontakti
- regjistrim ne newsletter

Keto veprime kthejne pergjigje dinamike dhe ndihmojne qe faqja te ndihet me moderne dhe me e shpejte.

## Faqet Kryesore

Platforma perfshin faqe qe e bejne projektin te duket si dyqan i plote:

- **Ballina**: prezantim premium, hero, best sellers, oferta, brende dhe seksione editoriale.
- **Koleksioni**: katalog dinamik me search, filtra, sortim dhe pagination.
- **Product Detail**: faqe e dedikuar per secilen ore.
- **Favorites**: lista e produkteve te ruajtura.
- **Cart**: shporta me produkte dhe total.
- **Blog**: artikuj rreth orave, brendeve dhe zgjedhjeve te blerjes.
- **FAQ**: pyetje dhe pergjigje per blerje, kthim, garanci dhe porosi.
- **Sell Your Watch**: faqe per perdorues qe duan te shesin oren e tyre.
- **Rreth nesh**: prezantim i dyqanit dhe qasjes se tij.
- **Kontakt**: forme kontakti dhe informacion per komunikim.
- **Login / Register**: autentikim per perdorues dhe admin.

## Admin Panel

Admin paneli eshte pjesa ku menaxhohet sistemi. Ai eshte ndertuar per te treguar si nje pronar dyqani mund te kontrolloje permbajtjen dhe te dhenat.

Admini mund te shikoje:

- dashboard-in
- produktet
- perdoruesit
- brendet
- kategorite
- ofertat
- porosite
- artikujt / blog content
- mesazhet e kontaktit
- regjistrimet ne newsletter
- tabelat kryesore te databazes

Admini real mund te:

- shtoje produkte te reja
- ndryshoje produkte ekzistuese
- fshije produkte
- menaxhoje cmimet
- vendose ose ndryshoje zbritjet
- perditesoje stokun
- ndryshoje imazhin e produktit
- menaxhoje brendet
- menaxhoje kategorite
- menaxhoje ofertat
- shikoje perdoruesit
- ndryshoje role te perdoruesve
- shikoje porosite
- shikoje kontaktet e derguara nga vizitoret
- shikoje newsletter subscribers

## Demo Admin

Per shkak se projekti eshte demo portfolio, ekziston edhe nje demo admin qe lejon shikimin e panelit pa lejuar ndryshime reale.

Demo admin mund te:

- hyje ne admin panel
- shikoje dashboard-in
- shikoje listat dhe tabelat
- shikoje produktet, userat, kontaktet dhe newsletter
- kuptoje si duket paneli administrativ

Demo admin nuk mund te:

- shtoje te dhena
- ndryshoje produkte
- fshije produkte
- ndryshoje perdorues
- ndryshoje role
- fshije kontakte ose porosi
- beje veprime qe ndryshojne databazen

Nese demo admin tenton te kryeje nje veprim te tille, aplikacioni e ndalon dhe tregon mesazh qe kjo qasje eshte vetem per shikim. Kjo e mbron projektin nga ndryshimet e padeshiruara kur dikush e teston per portfolio.

## Databaza

Databaza mban te dhenat kryesore te platformes:

- produktet
- brendet
- kategorite
- ofertat
- perdoruesit
- rolet
- shporta / porosite
- order items
- kontaktet
- newsletter subscribers
- metadata per login dhe admin

Produktet nuk jane hardcoded ne HTML. Ato lexohen nga databaza dhe shfaqen ne katalog, search, filter, product detail dhe admin panel.

## Siguria Dhe Kontrolli

Projekti perfshin disa praktika baze sigurie:

- password hashing per llogarite
- role per perdorues dhe administrator
- kontroll qasjeje ne admin panel
- CSRF token per forma
- server-side validation
- prepared SQL statements
- ndalim i veprimeve shkruese per demo admin
- fshehje e admin controls nga storefront

Kartelat bankare nuk ruhen ne sistem. Projekti eshte demo dhe nuk proceson pagesa reale.

## Dizajni

Dizajni eshte menduar per nje dyqan orash me ndjesi premium:

- ngjyra near-black, warm white, muted gray dhe gold accent
- font modern dhe i paster
- spacing i forte
- produktet ne fokus
- imazhe te medha
- kartela te pastra
- hover efekte te buta
- layout responsive per desktop, tablet dhe mobile

Qellimi eshte qe faqja te mos duket si template e thjeshte, por si nje projekt portfolio i kuruar me kujdes.

## Qellimi I Projektit

Watches Prishtina eshte krijuar per te demonstruar nje e-commerce funksional dhe profesional. Projekti tregon aftesi ne UI, backend, databaze, admin panel, search, filter, AJAX interactions dhe organizim aplikacioni.

Ky projekt mund te sherbeje si baze per nje dyqan real, por ne kete forme eshte i fokusuar si demo portfolio per prezantim profesional.

## Kredite

Zhvilluar nga **Arlind Hyseni** si projekt personal web.

Realizuar gjithashtu me ndihmen e AI per planifikim, dizajn, permiresim UI dhe zhvillim.
