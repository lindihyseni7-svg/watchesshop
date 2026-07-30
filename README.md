# Watches Prishtina

Ecommerce i plote per ora, i ndertuar me PHP 8.2, MariaDB/MySQL, HTML, CSS dhe JavaScript pa framework te rende. Projekti punon ne XAMPP dhe perdor clean routes, arkitekture controller/repository/service, role, CRUD admin, cart AJAX, favorites, katalog dinamik dhe migrations te versionuara ne Git.

## A duhet phpMyAdmin?

Jo. phpMyAdmin eshte vetem nje UI per ta pare ose ndryshuar MySQL-in.

Projekti ka ende nevoje per:

- Apache te ndezur ne XAMPP.
- MySQL te ndezur ne XAMPP.
- Databazen `watches`.

Migrations ruhen si files `.sql` ne VS Code dhe ekzekutohen ne MySQL. Kjo do te thote se struktura e databazes kontrollohet nga Git, por te dhenat reale vazhdojne te jetojne ne MySQL.

Mund ta kontrollosh databazen me phpMyAdmin, MySQL CLI ose nga paneli admin i aplikacionit. Per punen e perditshme me produkte, perdorues, brende, kategori dhe oferta nuk ke me nevoje te hysh ne phpMyAdmin.

## Nisja lokale

1. Vendose projektin ne:

```text
C:\xampp\htdocs\watchesshop
```

2. Nise Apache dhe MySQL nga XAMPP.

3. Krijo databazen nese nuk ekziston:

```powershell
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS watches CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

4. Apliko migrations sipas rendit:

```powershell
Get-ChildItem database\migrations\*.sql | Sort-Object Name | ForEach-Object {
    Get-Content -Raw $_.FullName | C:\xampp\mysql\bin\mysql.exe -u root watches
}
```

5. Hape aplikacionin:

```text
http://localhost/watchesshop/
```

## Konfigurimi i databazes

Vlerat lokale default:

| Setting | Vlera |
|---|---|
| Host | `localhost` |
| User | `root` |
| Password | bosh |
| Database | `watches` |

Mund te ndryshohen me environment variables:

```text
DB_HOST
DB_USER
DB_PASS
DB_NAME
```

Lidhja menaxhohet nga `src/Core/Database.php`.

Ne hosting falas, zakonisht nuk ke environment variables. Per kete arsye projekti
mbeshtet edhe konfigurim privat me file:

```text
config/database.php
```

Kopjo `config/database.sample.php`, riemertoje ne `config/database.php` dhe
vendos kredencialet reale qe t'i jep paneli i hosting-ut. Ky file eshte i
injoruar nga Git, sepse aty ka password te databazes.

Ne `localhost`, aplikacioni perdor automatikisht databazen lokale `watches`
edhe nese ekziston `config/database.php` me kredencialet e hosting-ut. Kjo lejon
te zhvillosh ne XAMPP pa e prishur konfigurimin live. Nese do ta testosh
lokalisht me `config/database.php`, vendos:

```text
DB_USE_CONFIG_FILE=1
```

```php
<?php
declare(strict_types=1);

return [
    'host' => 'sqlXXX.infinityfree.com',
    'user' => 'if0_00000000',
    'password' => 'password-i-real',
    'database' => 'if0_00000000_watchesshop',
    'port' => 3306,
];
```

## Struktura e projektit

```text
watchesshop/
|-- database/
|   |-- backups/              Backup lokale, te injoruara nga Git
|   `-- migrations/           Versionet e skemes dhe seed data
|-- public/
|   `-- assets/
|       |-- css/app.css       Dizajni i storefront, auth dhe admin
|       |-- js/app.js         Cart, favorites, forma dhe UI interactions
|       `-- images/           Asetet e storefront
|-- routes/
|   |-- web.php               Storefront, login dhe register
|   |-- api.php               Endpoints JSON/AJAX
|   `-- admin.php             Routes e panelit administrator
|-- src/
|   |-- Controllers/
|   |   |-- StoreController.php
|   |   |-- AuthController.php
|   |   `-- AdminController.php
|   |-- Core/
|   |   `-- Database.php
|   |-- Repositories/
|   |   |-- ProductRepository.php
|   |   |-- UserRepository.php
|   |   |-- AdminRepository.php
|   |   `-- CommunicationRepository.php
|   |-- Services/
|   |   |-- AuthService.php
|   |   |-- CartService.php
|   |   `-- FavoriteService.php
|   |-- Views/
|   |   |-- components/       Product card dhe admin navigation
|   |   |-- layouts/          Header dhe footer
|   |   `-- pages/            Storefront, auth dhe admin pages
|   `-- bootstrap.php         Session, autoload dhe helper functions
|-- index.php                 Front controller
`-- .htaccess                 Clean URL routing
```

## Si kalon nje request?

```text
Browser
  -> .htaccess
  -> index.php
  -> routes/web.php, routes/api.php ose routes/admin.php
  -> Controller
  -> Repository/Service
  -> View ose JSON response
```

`index.php` trajton edhe routes me parametra:

```text
/product/{slug}
/admin/{entity}/{id}/edit
/admin/{entity}/{id}/delete
```

## Autentikimi dhe rolet

Ekzistojne dy role:

### Perdorues

- Krijohet nga `/register`.
- Mund te kyçet nga `/login`.
- Ka qasje ne storefront, cart dhe favorites.
- Nuk mund te hyje ne `/admin`.

### Administrator

- Mund te hyje nga e njejta faqe `/login`.
- Pas login ridrejtohet te `/admin`.
- Mund te menaxhoje produkte, perdorues, brende, kategori dhe oferta.
- Vetem nje administrator mund t'ia ndryshoje rolin nje perdoruesi.
- Administratori nuk mund ta fshije llogarine me te cilen eshte aktualisht i kycur.

Regjistrimi publik e vendos rolin gjithmone `Perdorues`. Fusha `role` nga browser nuk besohet.

Password-et e reja ruhen me `password_hash()`. Nese nje llogari e vjeter ka password plaintext, login-i i pare valid e konverton automatikisht ne hash.

## Paneli administrator

Hyrja:

```text
http://localhost/watchesshop/admin
```

Modulet:

| Moduli | Route | Veprimet |
|---|---|---|
| Produktet | `/admin/products` | Listo, shto, modifiko, fshij |
| Perdoruesit | `/admin/users` | Listo, shto, ndrysho rol/password, fshij |
| Brendet | `/admin/brands` | Listo, shto, modifiko, fshij |
| Kategorite | `/admin/categories` | Listo, shto, modifiko, fshij |
| Ofertat | `/admin/offers` | Listo, shto, modifiko, fshij |

Te gjitha veprimet shkruese perdorin:

- POST requests.
- CSRF token.
- Prepared SQL statements.
- Kontroll te rolit Administrator.
- Server-side validation.

## Si shtohet nje ore e re?

1. Kycu me nje llogari Administrator.
2. Hape `/admin/products`.
3. Kliko `Shto produkt`.
4. Ploteso emrin, modelin, brendin, cmimin, stokun dhe pershkrimin.
5. Vendose imazhin si path relativ, per shembull:

```text
img/o34.jpg
```

6. Zgjidh kategorine dhe oferten nese aplikohen.
7. Ruaj produktin.

Slug gjenerohet automatikisht nga emri dhe modeli. Produkti shfaqet direkt ne katalog, search, filtra dhe pagination. Nuk ka numer fiks produktesh ne kod.

## Migrations

| File | Qellimi |
|---|---|
| `001_expand_catalog.sql` | Zgjeron tabelen e produkteve dhe shton katalogun fillestar |
| `002_product_image_mapping.sql` | Lidh produktet me fotografite |
| `003_commerce_tables.sql` | Contact, newsletter, orders dhe order items |
| `004_auth_admin_catalog.sql` | Role, login metadata, kategori/oferta te produktit dhe produkte shtese |

Para ndryshimeve te medha krijo backup:

```powershell
C:\xampp\mysql\bin\mysqldump.exe -u root --result-file=database\backups\watches-backup.sql watches
```

Folderi `database/backups` dhe dump files nuk dergohen ne GitHub.

## Deploy falas ne InfinityFree

InfinityFree eshte opsioni me i thjeshte falas per kete projekt, sepse ofron
PHP, MySQL/MariaDB, `.htaccess`, SSL dhe subdomain falas.

### 1. Krijo databazen

Ne panelin e InfinityFree:

- Hape `MySQL Databases`.
- Krijo nje databaze te re, per shembull `watchesshop`.
- Ruaji vlerat `MySQL Hostname`, `MySQL Database Name`, `MySQL Username` dhe
  password-in e panelit.

### 2. Importo databazen

Ne `phpMyAdmin` te InfinityFree importo kete file:

```text
database/deploy/infinityfree_install.sql
```

Ky file eshte installer i plote per databaze bosh. Ai krijon tabelat bazike,
pastaj aplikon migrations e projektit dhe shton katalogun me produkte.

Llogarite demo pas importit:

| Roli | Email | Password |
|---|---|---|
| Administrator | `admin@watchesshop.test` | `admin12345` |
| Perdorues | `user@watchesshop.test` | `user12345` |

Pas deploy-it ndrysho password-in e administratorit nga paneli admin.

### 3. Vendos kredencialet e databazes

Krijo file:

```text
config/database.php
```

Merr shembullin nga `config/database.sample.php` dhe vendos vlerat reale te
InfinityFree. Mos e publiko kete file ne GitHub.

### 4. Upload files

Ngarko permbajtjen e projektit ne folderin publik te InfinityFree:

```text
htdocs/
```

Duhet te jene ne root te `htdocs`, per shembull:

```text
htdocs/
|-- index.php
|-- .htaccess
|-- config/
|-- database/
|-- img/
|-- public/
|-- routes/
`-- src/
```

Nese e vendos ne subfolder, routing prap punon, por deploy me domain root eshte
me i paster.

### 5. Testo pas deploy

Kontrollo keto URL:

```text
/
/shop
/login
/register
/admin
/cart
/favorites
/contact
```

Pastaj provo:

- Login si administrator.
- Shto/modifiko/fshij nje produkt nga `/admin/products`.
- Register nje user te ri.
- Shto produkt ne cart pa refresh.
- Shto produkt ne favorites pa refresh.
- Kerko, filtro dhe sorto ne `/shop`.

### Probleme te zakonshme

| Simptoma | Zgjidhja |
|---|---|
| `Lidhja me databazen deshtoi` | Kontrollo `config/database.php`: host, user, password, database |
| 404 ne routes si `/shop` | Kontrollo qe `.htaccess` eshte upload ne `htdocs` |
| Imazhet nuk shfaqen | Kontrollo qe folderi `img/` eshte upload komplet |
| Login nuk punon | Sigurohu qe `perdoruesit` u importua dhe sessions jane aktive |
| Cart/favorites nuk ndryshojne | Kontrollo browser console dhe qe URL `/api/...` nuk kthen 404 |

## Si behen ndryshimet live

Rrjedha e rekomanduar eshte:

```text
VS Code ne localhost
  -> testo ne http://localhost/watchesshop/
  -> commit ne Git
  -> upload vetem file-t e ndryshuar ne InfinityFree htdocs
```

InfinityFree nuk lidhet automatikisht me GitHub ne planin falas. Ndryshimet nuk
dalin live vetem pse i ndryshon ne VS Code ose pse ben `git push`.

Per ndryshime te shpejta:

- Ndrysho file-in ne VS Code.
- Testo ne localhost.
- Upload te njejtin file ne `htdocs` me File Manager ose FTP.
- Bej refresh ne browser me `Ctrl + F5`.

Per ndryshime me databaze:

- Krijo nje migration te ri ne `database/migrations`.
- Testoje lokalisht.
- Ekzekuto SQL-in ne phpMyAdmin te InfinityFree.
- Upload file-t PHP/CSS/JS qe u ndryshuan.

Mos e upload-o `config/database.php` nga localhost nese aty ke vlera lokale.
Ne InfinityFree ai file duhet te mbaje kredencialet e hosting-ut.

## Storefront routes

```text
/
/shop
/product/{slug}
/favorites
/cart
/about
/contact
/faq
/login
/register
```

URL-te e vjetra si `orat.php`, `shporta.php`, `shto_modifiko_*.php` dhe `fshij*.php` ekzistojne vetem si redirects kompatibiliteti. Logjika e tyre eshte zhvendosur ne routes dhe controllers.

## API routes

```text
POST /api/cart/add
POST /api/cart/update
POST /api/favorites/toggle
POST /api/contact
POST /api/newsletter
```

Cart dhe favorites punojne pa page refresh.

## Kontrolli i kodit

Kontrollo sintaksen PHP:

```powershell
Get-ChildItem -Recurse -Filter *.php | ForEach-Object {
    C:\xampp\php\php.exe -l $_.FullName
}
```

Kontrollo statusin e Git:

```powershell
git status
git log --oneline -5
```

## Rregullat per zhvillim

- SQL i ri vendoset ne nje migration te ri, jo duke ndryshuar manualisht production DB.
- Queries vendosen ne repositories.
- Logjika e biznesit vendoset ne services.
- Request handling vendoset ne controllers.
- HTML vendoset ne views.
- Routes deklarohen ne folderin `routes`.
- Komentet shpjegojne rolin e file-it ose logjiken jo te dukshme; emrat e qarte te klasave dhe metodave dokumentojne pjesen tjeter.
- Mos ruaj passwords, `.env`, database dumps ose backups ne Git.
