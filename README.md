# Watches Prishtina

Storefront ecommerce ne PHP 8.2 dhe MariaDB, i optimizuar per XAMPP.

## Nisja lokale

1. Vendose projektin ne `C:\xampp\htdocs\watchesshop`.
2. Nise Apache dhe MySQL nga XAMPP.
3. Krijo databazen `watches` nese nuk ekziston.
4. Apliko migrations sipas rendit:

```powershell
Get-Content -Raw database\migrations\001_expand_catalog.sql | C:\xampp\mysql\bin\mysql.exe -u root watches
Get-Content -Raw database\migrations\002_product_image_mapping.sql | C:\xampp\mysql\bin\mysql.exe -u root watches
Get-Content -Raw database\migrations\003_commerce_tables.sql | C:\xampp\mysql\bin\mysql.exe -u root watches
```

5. Hape `http://localhost/watchesshop/`.

Lidhja lokale perdor keto vlera si default:

- Host: `localhost`
- User: `root`
- Password: bosh
- Database: `watches`

Mund te ndryshohen me environment variables `DB_HOST`, `DB_USER`, `DB_PASS` dhe `DB_NAME`.

## Struktura

```text
watchesshop/
|-- database/
|   `-- migrations/       Ndryshimet e skemes dhe seed data
|-- public/
|   `-- assets/           CSS, JavaScript dhe imazhet e storefront-it
|-- routes/
|   |-- web.php           Routes e faqeve
|   `-- api.php           Endpoints AJAX
|-- src/
|   |-- Controllers/      Kontrolli i faqeve
|   |-- Core/             Lidhja me databazen
|   |-- Repositories/     Queries dhe data access
|   |-- Services/         Cart dhe favorites
|   `-- Views/            Layouts, faqe dhe komponente
|-- index.php             Front controller
`-- .htaccess             Clean URL routing
```

Faqet e vjetra te administrimit ruhen ne root per kompatibilitet. Storefront-i i ri perdor clean routes si `/shop`, `/product/{slug}`, `/favorites`, `/cart`, `/about`, `/contact` dhe `/faq`.

## Kontrolli i sintakses

```powershell
Get-ChildItem -Recurse -Filter *.php | ForEach-Object {
    C:\xampp\php\php.exe -l $_.FullName
}
```
