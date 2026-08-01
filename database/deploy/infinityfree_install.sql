SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE IF NOT EXISTS perdoruesit (
    perdoruesiid INT NOT NULL AUTO_INCREMENT,
    emri VARCHAR(100) NOT NULL,
    mbiemri VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL,
    fjalekalimi VARCHAR(255) NOT NULL,
    telefoni VARCHAR(50) NULL,
    nrpersonal VARCHAR(50) NULL,
    role VARCHAR(30) NOT NULL DEFAULT 'Perdorues',
    PRIMARY KEY (perdoruesiid),
    UNIQUE KEY uq_perdoruesit_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS brendet (
    brendetid INT NOT NULL AUTO_INCREMENT,
    emri VARCHAR(120) NOT NULL,
    vitthemelimi INT NULL,
    vendndodhja VARCHAR(120) NULL,
    website VARCHAR(255) NULL,
    PRIMARY KEY (brendetid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS kategorite (
    kategoriaid INT NOT NULL AUTO_INCREMENT,
    emri VARCHAR(120) NOT NULL,
    pershkrimi TEXT NULL,
    kostoja DECIMAL(10,2) NOT NULL DEFAULT 0,
    PRIMARY KEY (kategoriaid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS ofertat (
    OfertaID INT NOT NULL AUTO_INCREMENT,
    EmriOfertes VARCHAR(120) NOT NULL,
    Zbritja DECIMAL(5,2) NOT NULL DEFAULT 0,
    DataFillimit DATE NOT NULL,
    DataSkadimit DATE NOT NULL,
    PRIMARY KEY (OfertaID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS orat (
    id INT NOT NULL AUTO_INCREMENT,
    emri VARCHAR(180) NOT NULL,
    modeli VARCHAR(140) NOT NULL,
    cmimi DECIMAL(12,2) NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO perdoruesit
    (perdoruesiid, emri, mbiemri, email, fjalekalimi, telefoni, nrpersonal, role)
VALUES
    (1, 'Admin', 'Watches', 'admin@watchesshop.test', '$2y$10$K9p9zPezMmCt5mtl3YhZI.YIjUl6GN3DGGFlDbjGzrS.Z8hJoD8A.', '+38344111222', '1000000001', 'Administrator'),
    (2, 'Demo', 'User', 'user@watchesshop.test', '$2y$10$svEDOOlWgUf0MMT27TjsuObLQGskRzLG1s4yxB3oUCwBSs1xoV9uG', '+38344111333', '1000000002', 'Perdorues'),
    (3, 'Demo', 'Admin', 'demo.admin@watchesshop.test', '$2y$10$PWvvtEB5u9TnxqdtTyyk2uYgTARB0aoEcAjtaJmvcwfu44hJt4vhq', '+38344111444', '1000000003', 'DemoAdmin');

INSERT IGNORE INTO brendet (brendetid, emri, vitthemelimi, vendndodhja, website) VALUES
    (1, 'Rolex', 1905, 'Zvicer', 'https://www.rolex.com'),
    (2, 'Casio', 1946, 'Japoni', 'https://www.casio.com');

INSERT IGNORE INTO kategorite (kategoriaid, emri, pershkrimi, kostoja) VALUES
    (1, 'Elegante', 'Modele elegante per evente dhe perditshmeri premium', 100),
    (2, 'Sportive', 'Modele rezistente per perdorim aktiv', 90);

INSERT IGNORE INTO ofertat (OfertaID, EmriOfertes, Zbritja, DataFillimit, DataSkadimit) VALUES
    (1, 'Summer Time Deals', 10, '2026-01-01', '2027-12-31');

INSERT IGNORE INTO orat (id, emri, modeli, cmimi) VALUES
    (1, 'Rolex Submariner', 'Submariner 116610', 8500.00),
    (2, 'Casio Edifice', 'EFR-556', 150.00),
    (3, 'Rolex Daytona', 'Daytona 116500', 12000.00),
    (4, 'Casio G-Shock', 'GA-2100', 99.00),
    (5, 'Rolex Datejust', 'Datejust 126200', 7200.00),
    (6, 'Casio Vintage', 'A168WA', 45.00);

SET FOREIGN_KEY_CHECKS = 1;


-- Expand the original four-column watch table into a searchable ecommerce catalog.
ALTER TABLE orat
    ADD COLUMN IF NOT EXISTS slug VARCHAR(180) NULL AFTER id,
    ADD COLUMN IF NOT EXISTS brand VARCHAR(100) NOT NULL DEFAULT '' AFTER slug,
    ADD COLUMN IF NOT EXISTS pershkrimi TEXT NULL AFTER cmimi,
    ADD COLUMN IF NOT EXISTS historia TEXT NULL AFTER pershkrimi,
    ADD COLUMN IF NOT EXISTS image VARCHAR(255) NULL AFTER historia,
    ADD COLUMN IF NOT EXISTS discount_percent DECIMAL(5,2) NOT NULL DEFAULT 0 AFTER image,
    ADD COLUMN IF NOT EXISTS popularity INT NOT NULL DEFAULT 0 AFTER discount_percent,
    ADD COLUMN IF NOT EXISTS is_new TINYINT(1) NOT NULL DEFAULT 0 AFTER popularity,
    ADD COLUMN IF NOT EXISTS stock INT NOT NULL DEFAULT 10 AFTER is_new,
    ADD COLUMN IF NOT EXISTS movement VARCHAR(100) NULL AFTER stock,
    ADD COLUMN IF NOT EXISTS material VARCHAR(100) NULL AFTER movement,
    ADD COLUMN IF NOT EXISTS water_resistance VARCHAR(80) NULL AFTER material,
    ADD COLUMN IF NOT EXISTS created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER water_resistance;

UPDATE orat SET
    slug = CASE id
        WHEN 1 THEN 'rolex-submariner-116610'
        WHEN 2 THEN 'casio-edifice-efr-556'
        WHEN 3 THEN 'rolex-daytona-116500'
        WHEN 4 THEN 'casio-g-shock-ga-2100'
        WHEN 5 THEN 'rolex-datejust-126200'
        WHEN 6 THEN 'casio-vintage-a168wa'
    END,
    brand = CASE WHEN emri LIKE 'Rolex%' THEN 'Rolex' ELSE 'Casio' END,
    pershkrimi = CASE
        WHEN id = 1 THEN 'Ore profesionale diver me prezence ikonike, bezel preciz dhe konstruksion te qendrueshem.'
        WHEN id = 2 THEN 'Kronograf sportiv me kasete solide dhe lexim te qarte per perdorim te perditshem.'
        WHEN id = 3 THEN 'Kronograf legjendar i frymezuar nga motorsporti dhe matja precize e kohes.'
        WHEN id = 4 THEN 'Dizajn urban rezistent ndaj goditjeve, i lehte dhe gati per cdo aventure.'
        WHEN id = 5 THEN 'Elegance klasike me proporcion te balancuar dhe identitet te dallueshem.'
        ELSE 'Ikone digjitale retro, kompakte dhe funksionale per perdorim te perditshem.'
    END,
    historia = 'Secila ore ne koleksion zgjidhet per dizajnin, trashegimine dhe vleren qe ruan me kohe.',
    image = CASE id
        WHEN 1 THEN 'img/o0.jpg'
        WHEN 2 THEN 'img/o10.jpg'
        WHEN 3 THEN 'img/o11.jpg'
        WHEN 4 THEN 'img/o12.jpg'
        WHEN 5 THEN 'img/o13.jpg'
        ELSE 'img/o14.jpg'
    END,
    discount_percent = CASE id WHEN 2 THEN 12 WHEN 4 THEN 10 WHEN 6 THEN 15 ELSE 0 END,
    popularity = CASE id WHEN 1 THEN 98 WHEN 3 THEN 96 WHEN 4 THEN 91 WHEN 5 THEN 88 ELSE 72 END,
    is_new = CASE WHEN id IN (3, 4) THEN 1 ELSE 0 END,
    stock = CASE WHEN id = 3 THEN 2 ELSE 8 END,
    movement = CASE WHEN brand = 'Rolex' THEN 'Automatic' ELSE 'Quartz' END,
    material = 'Stainless steel',
    water_resistance = CASE WHEN id IN (1, 4) THEN '200 m' ELSE '50 m' END
WHERE id BETWEEN 1 AND 6;

INSERT IGNORE INTO orat
    (slug, brand, emri, modeli, cmimi, pershkrimi, historia, image, discount_percent, popularity, is_new, stock, movement, material, water_resistance)
VALUES
('omega-speedmaster-moonwatch', 'Omega', 'Omega Speedmaster Moonwatch', '310.30.42.50.01.001', 7600, 'Kronograf profesional me dial te zi dhe shkalle tachymeter.', 'Speedmaster u be pjese e historise se eksplorimit hapesinor dhe mbetet nje nga kronografet me te njohur.', 'img/o15.jpg', 0, 94, 1, 4, 'Manual mechanical', 'Stainless steel', '50 m'),
('omega-seamaster-diver-300m', 'Omega', 'Omega Seamaster Diver 300M', '210.30.42.20.03.001', 5900, 'Diver modern me dial qeramike dhe performance profesionale.', 'Seamaster lidh trashegimine detare me inxhinieri bashkekohore.', 'img/o16.jpg', 8, 90, 0, 6, 'Automatic', 'Steel and ceramic', '300 m'),
('tissot-prx-powermatic-80', 'Tissot', 'Tissot PRX Powermatic 80', 'T137.407.11.041.00', 775, 'Sport elegance me bracelet te integruar dhe rezerve 80 ore.', 'PRX ringjall nje siluete te viteve shtatedhjete me mekanizem modern.', 'img/o17.jpg', 10, 89, 1, 12, 'Automatic', 'Stainless steel', '100 m'),
('tissot-gentleman-silicium', 'Tissot', 'Tissot Gentleman Silicium', 'T127.407.11.051.00', 825, 'Ore versatile me balancim klasik dhe teknologji siliciumi.', 'Krijuar per te kaluar natyrshem nga puna ne mbremje.', 'img/o18.jpg', 0, 78, 0, 9, 'Automatic', 'Stainless steel', '100 m'),
('seiko-prospex-1968', 'Seiko', 'Seiko Prospex 1968', 'SPB185J1', 1250, 'Diver japonez me lexueshmeri te larte dhe ndertim robust.', 'Prospex vazhdon traditen Seiko ne orat profesionale per uje.', 'img/o19.jpg', 14, 87, 0, 7, 'Automatic', 'Stainless steel', '200 m'),
('seiko-presage-sharp-edged', 'Seiko', 'Seiko Presage Sharp Edged', 'SPB167J1', 1000, 'Dial me teksture japoneze dhe profil elegant bashkekohor.', 'Presage kombinon mjeshterine tradicionale japoneze me mekanike automatike.', 'img/o20.jpg', 0, 80, 1, 5, 'Automatic', 'Stainless steel', '100 m'),
('tag-heuer-carrera-chronograph', 'TAG Heuer', 'TAG Heuer Carrera Chronograph', 'CBS2210.FC6534', 6450, 'Kronograf racing me xham dome dhe dial panda.', 'Carrera lindi nga bota e garave dhe mban nje identitet te paster sportiv.', 'img/o21.jpg', 5, 92, 1, 3, 'Automatic chronograph', 'Stainless steel', '100 m'),
('tag-heuer-aquaracer-300', 'TAG Heuer', 'TAG Heuer Aquaracer 300', 'WBP201A.BA0632', 3400, 'Ore teknike per zhytje me bezel qeramike dhe bracelet solid.', 'Aquaracer eshte projektuar per performance, kontrast dhe besueshmeri ne uje.', 'img/o22.jpg', 12, 83, 0, 6, 'Automatic', 'Steel and ceramic', '300 m'),
('longines-spirit-zulu-time', 'Longines', 'Longines Spirit Zulu Time', 'L3.812.4.63.6', 3150, 'GMT i rafinuar per udhetime me dy zona kohore.', 'Emri Zulu Time kujton instrumentet Longines te piloteve dhe eksploruesve.', 'img/o23.jpg', 0, 86, 1, 8, 'Automatic GMT', 'Stainless steel', '100 m'),
('longines-master-collection', 'Longines', 'Longines Master Collection', 'L2.793.4.78.6', 2450, 'Dress watch klasik me dial argjendi dhe numerues elegant.', 'Master Collection perfaqeson mekaniken tradicionale dhe estetiken e perjetshme.', 'img/o24.jpg', 9, 77, 0, 10, 'Automatic', 'Stainless steel', '30 m'),
('citizen-tsuyosa-yellow', 'Citizen', 'Citizen Tsuyosa Yellow', 'NJ0150-81Z', 450, 'Ore automatike energjike me bracelet te integruar dhe dial te verdhe.', 'Tsuyosa sjell ngjyre dhe mekanike japoneze ne nje format te perditshem.', 'img/o25.jpg', 18, 84, 1, 14, 'Automatic', 'Stainless steel', '50 m'),
('hamilton-khaki-field-auto', 'Hamilton', 'Hamilton Khaki Field Auto', 'H70455533', 695, 'Field watch i paster, i lexueshem dhe i ndertuar per aventure.', 'Khaki Field mbeshtetet ne trashegimine e orave ushtarake Hamilton.', 'img/o26.jpg', 7, 85, 0, 11, 'Automatic', 'Stainless steel', '100 m'),
('cartier-santos-medium', 'Cartier', 'Cartier Santos Medium', 'WSSA0029', 7050, 'Ikone elegante me kasete katrore dhe bracelet te integruar.', 'Santos u krijua per aviatorin Alberto Santos-Dumont dhe ndryshoi historine e ores se dores.', 'img/o27.jpg', 0, 95, 1, 2, 'Automatic', 'Stainless steel', '100 m'),
('breitling-navitimer-b01', 'Breitling', 'Breitling Navitimer B01', 'AB0138211B1P1', 9400, 'Kronograf aviacioni me slide rule dhe mekanizem manufacture.', 'Navitimer ka sherbyer si instrument i piloteve qe nga vitet pesedhjete.', 'img/o28.jpg', 6, 88, 0, 3, 'Automatic chronograph', 'Stainless steel', '30 m');

UPDATE orat SET slug = CONCAT('watch-', id) WHERE slug IS NULL OR slug = '';
ALTER TABLE orat ADD UNIQUE INDEX IF NOT EXISTS uq_orat_slug (slug);
CREATE INDEX IF NOT EXISTS idx_orat_brand ON orat (brand);
CREATE INDEX IF NOT EXISTS idx_orat_catalog ON orat (is_new, popularity, discount_percent, cmimi);


-- Match seeded products to local watch photography and correct catalog naming.
UPDATE orat SET image = CASE slug
    WHEN 'rolex-submariner-116610' THEN 'img/o34.jpg'
    WHEN 'casio-edifice-efr-556' THEN 'img/o35.jpg'
    WHEN 'rolex-daytona-116500' THEN 'img/o38.jpg'
    WHEN 'casio-g-shock-ga-2100' THEN 'img/o32.jpg'
    WHEN 'rolex-datejust-126200' THEN 'img/o15.jpg'
    WHEN 'casio-vintage-a168wa' THEN 'img/o33.jpg'
    WHEN 'omega-speedmaster-moonwatch' THEN 'img/o12.jpg'
    WHEN 'omega-seamaster-diver-300m' THEN 'img/o19.jpg'
    WHEN 'tissot-prx-powermatic-80' THEN 'img/o36.jpg'
    WHEN 'tissot-gentleman-silicium' THEN 'img/o22.jpg'
    WHEN 'seiko-prospex-1968' THEN 'img/ora2.jpg'
    WHEN 'seiko-presage-sharp-edged' THEN 'img/o30.jpg'
    WHEN 'tag-heuer-carrera-chronograph' THEN 'img/o37.jpg'
    WHEN 'tag-heuer-aquaracer-300' THEN 'img/o35.jpg'
    WHEN 'longines-spirit-zulu-time' THEN 'img/o39.jpg'
    WHEN 'longines-master-collection' THEN 'img/o21.jpg'
    WHEN 'citizen-tsuyosa-yellow' THEN 'img/o6.jpg'
    WHEN 'hamilton-khaki-field-auto' THEN 'img/o5.jpg'
    WHEN 'cartier-santos-medium' THEN 'img/o31.jpg'
    WHEN 'breitling-navitimer-b01' THEN 'img/o38.jpg'
    ELSE image
END;

UPDATE orat
SET slug = 'citizen-tsuyosa-blue',
    emri = 'Citizen Tsuyosa Blue',
    modeli = 'NJ0150-81L',
    pershkrimi = 'Ore automatike energjike me bracelet te integruar dhe dial te kalter.'
WHERE slug = 'citizen-tsuyosa-yellow';


-- Add customer communication and the order persistence foundation.
CREATE TABLE IF NOT EXISTS contact_messages (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL,
    subject VARCHAR(160) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') NOT NULL DEFAULT 'new',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    INDEX idx_contact_status_created (status, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(190) NOT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    source VARCHAR(80) NOT NULL DEFAULT 'footer',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_newsletter_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS watch_sale_requests (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(160) NOT NULL,
    email VARCHAR(190) NOT NULL,
    phone VARCHAR(50) NULL,
    watch_brand VARCHAR(120) NOT NULL,
    watch_reference VARCHAR(160) NOT NULL,
    watch_year INT NULL,
    watch_condition VARCHAR(80) NOT NULL,
    included_items VARCHAR(160) NULL,
    image_link VARCHAR(255) NULL,
    notes TEXT NULL,
    estimated_value_min DECIMAL(12,2) NULL,
    estimated_value_max DECIMAL(12,2) NULL,
    status ENUM('new', 'reviewing', 'offer_sent', 'accepted', 'declined', 'closed') NOT NULL DEFAULT 'new',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    INDEX idx_watch_sale_status_created (status, created_at),
    INDEX idx_watch_sale_brand_reference (watch_brand, watch_reference)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS orders (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    order_number VARCHAR(32) NOT NULL,
    user_id INT NULL,
    customer_name VARCHAR(160) NOT NULL,
    customer_email VARCHAR(190) NOT NULL,
    customer_phone VARCHAR(50) NULL,
    shipping_address TEXT NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    shipping_total DECIMAL(12,2) NOT NULL DEFAULT 0,
    grand_total DECIMAL(12,2) NOT NULL,
    status ENUM('pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_order_number (order_number),
    INDEX idx_order_status_created (status, created_at),
    CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES perdoruesit (perdoruesiid) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS order_items (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    order_id BIGINT UNSIGNED NOT NULL,
    product_id INT NULL,
    product_name VARCHAR(180) NOT NULL,
    model VARCHAR(120) NOT NULL,
    unit_price DECIMAL(12,2) NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    line_total DECIMAL(12,2) NOT NULL,
    PRIMARY KEY (id),
    INDEX idx_order_items_order (order_id),
    CONSTRAINT fk_order_items_order FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE,
    CONSTRAINT fk_order_items_product FOREIGN KEY (product_id) REFERENCES orat (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Normalize authentication, relate products to admin entities and extend the catalog.
ALTER TABLE perdoruesit
    ADD COLUMN IF NOT EXISTS last_login_at TIMESTAMP NULL AFTER role,
    ADD COLUMN IF NOT EXISTS created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER last_login_at;

UPDATE perdoruesit
SET role = CASE
    WHEN LOWER(role) IN ('admin', 'administrator') THEN 'Administrator'
    ELSE 'Perdorues'
END;

ALTER TABLE orat
    ADD COLUMN IF NOT EXISTS category_id INT NULL AFTER brand,
    ADD COLUMN IF NOT EXISTS offer_id INT NULL AFTER category_id;

ALTER TABLE brendet ADD UNIQUE INDEX IF NOT EXISTS uq_brendet_emri (emri);
ALTER TABLE kategorite ADD UNIQUE INDEX IF NOT EXISTS uq_kategorite_emri (emri);

INSERT IGNORE INTO brendet (emri, vitthemelimi, vendndodhja, website) VALUES
('Omega', 1848, 'Zvicer', 'https://www.omegawatches.com'),
('Tissot', 1853, 'Zvicer', 'https://www.tissotwatches.com'),
('Seiko', 1881, 'Japoni', 'https://www.seikowatches.com'),
('TAG Heuer', 1860, 'Zvicer', 'https://www.tagheuer.com'),
('Longines', 1832, 'Zvicer', 'https://www.longines.com'),
('Citizen', 1918, 'Japoni', 'https://www.citizenwatch.com'),
('Hamilton', 1892, 'Zvicer', 'https://www.hamiltonwatch.com'),
('Cartier', 1847, 'France', 'https://www.cartier.com'),
('Breitling', 1884, 'Zvicer', 'https://www.breitling.com'),
('Orient', 1950, 'Japoni', 'https://www.orientwatchusa.com'),
('Mido', 1918, 'Zvicer', 'https://www.midowatches.com'),
('Tudor', 1926, 'Zvicer', 'https://www.tudorwatch.com'),
('IWC', 1868, 'Zvicer', 'https://www.iwc.com'),
('Panerai', 1860, 'Itali', 'https://www.panerai.com'),
('Nomos', 1990, 'Gjermani', 'https://nomos-glashuette.com'),
('Zenith', 1865, 'Zvicer', 'https://www.zenith-watches.com'),
('Bulova', 1875, 'Shtetet e Bashkuara', 'https://www.bulova.com'),
('Frederique Constant', 1988, 'Zvicer', 'https://frederiqueconstant.com'),
('Rado', 1917, 'Zvicer', 'https://www.rado.com');

INSERT IGNORE INTO kategorite (emri, pershkrimi, kostoja) VALUES
('Diver', 'Ore profesionale me rezistence te larte ne uje', 150),
('Dress', 'Modele klasike dhe elegante per raste formale', 100),
('Chronograph', 'Ore me funksion kronografi dhe frymezim sportiv', 125),
('Field', 'Modele funksionale te frymezuara nga orat ushtarake', 75),
('GMT', 'Ore per udhetime me me shume se nje zone kohore', 130);

UPDATE orat SET category_id = (SELECT kategoriaid FROM kategorite WHERE emri = 'Diver' LIMIT 1)
WHERE emri REGEXP 'Submariner|Seamaster|Prospex|Aquaracer';
UPDATE orat SET category_id = (SELECT kategoriaid FROM kategorite WHERE emri = 'Chronograph' LIMIT 1)
WHERE emri REGEXP 'Daytona|Speedmaster|Carrera|Navitimer';
UPDATE orat SET category_id = (SELECT kategoriaid FROM kategorite WHERE emri = 'GMT' LIMIT 1)
WHERE emri LIKE '%Zulu%';
UPDATE orat SET category_id = (SELECT kategoriaid FROM kategorite WHERE emri = 'Elegante' LIMIT 1)
WHERE category_id IS NULL;
UPDATE orat SET offer_id = 1 WHERE discount_percent > 0;

INSERT IGNORE INTO orat
    (slug, brand, category_id, offer_id, emri, modeli, cmimi, pershkrimi, historia, image, discount_percent, popularity, is_new, stock, movement, material, water_resistance)
VALUES
('orient-bambino-version-8', 'Orient', (SELECT kategoriaid FROM kategorite WHERE emri='Dress' LIMIT 1), NULL, 'Orient Bambino Version 8', 'RA-AK0702Y10B', 420, 'Dress watch automatik me dial te ngrohte dhe xham dome.', 'Bambino e ka bere mekaniken klasike japoneze te arritshme per nje audience te gjere.', 'img/o10.jpg', 0, 76, 1, 15, 'Automatic', 'Stainless steel and leather', '30 m'),
('mido-ocean-star-200c', 'Mido', (SELECT kategoriaid FROM kategorite WHERE emri='Diver' LIMIT 1), 1, 'Mido Ocean Star 200C', 'M042.430.11.041.00', 1250, 'Diver zviceran me dial qeramike dhe rezerve te gjate energjie.', 'Ocean Star vazhdon traditen e Mido ne ora te besueshme per uje.', 'img/o19.jpg', 8, 82, 1, 7, 'Automatic', 'Steel and ceramic', '200 m'),
('tudor-black-bay-58', 'Tudor', (SELECT kategoriaid FROM kategorite WHERE emri='Diver' LIMIT 1), NULL, 'Tudor Black Bay 58', 'M79030N-0001', 4100, 'Diver me proporcion vintage dhe mekanizem manufacture.', 'Black Bay 58 frymezohet nga orat Tudor per zhytje te viteve pesedhjete.', 'img/o34.jpg', 0, 96, 1, 4, 'Automatic', 'Stainless steel', '200 m'),
('tudor-pelagos-39', 'Tudor', (SELECT kategoriaid FROM kategorite WHERE emri='Diver' LIMIT 1), 1, 'Tudor Pelagos 39', 'M25407N-0001', 4700, 'Diver modern prej titani me profil kompakt dhe profesional.', 'Pelagos kombinon funksionin e instrumentit me nje format te perditshem.', 'img/o27.jpg', 5, 91, 0, 5, 'Automatic', 'Titanium', '200 m'),
('iwc-portugieser-automatic-40', 'IWC', (SELECT kategoriaid FROM kategorite WHERE emri='Dress' LIMIT 1), NULL, 'IWC Portugieser Automatic 40', 'IW358304', 7450, 'Dress watch i paster me small seconds dhe proporcion klasik.', 'Portugieser u krijua nga kerkesa per precizion te ores detare ne format dore.', 'img/o21.jpg', 0, 88, 1, 3, 'Automatic', 'Stainless steel and leather', '30 m'),
('panerai-luminor-marina', 'Panerai', (SELECT kategoriaid FROM kategorite WHERE emri='Sportive' LIMIT 1), 1, 'Panerai Luminor Marina', 'PAM01312', 8200, 'Kasete e fuqishme me mbrojtes karakteristik te kurores.', 'Luminor lidhet me instrumentet profesionale detare te Panerai.', 'img/o11.jpg', 7, 84, 0, 3, 'Automatic', 'Stainless steel', '300 m'),
('nomos-tangente-38', 'Nomos', (SELECT kategoriaid FROM kategorite WHERE emri='Dress' LIMIT 1), NULL, 'Nomos Tangente 38', '165', 2430, 'Minimalizem Bauhaus me mekanizem manual nga Glashutte.', 'Tangente eshte modeli qe percaktoi gjuhen vizuale te Nomos.', 'img/a6.jpg', 0, 79, 1, 8, 'Manual mechanical', 'Stainless steel and leather', '30 m'),
('zenith-chronomaster-sport', 'Zenith', (SELECT kategoriaid FROM kategorite WHERE emri='Chronograph' LIMIT 1), NULL, 'Zenith Chronomaster Sport', '03.3100.3600/69.M3100', 11100, 'Kronograf high-beat me lexim te fraksioneve te sekondes.', 'El Primero mbetet nje nga mekanizmat automatike kronograf me te rendesishem.', 'img/o38.jpg', 0, 93, 1, 2, 'Automatic chronograph', 'Stainless steel', '100 m'),
('bulova-lunar-pilot', 'Bulova', (SELECT kategoriaid FROM kategorite WHERE emri='Chronograph' LIMIT 1), 1, 'Bulova Lunar Pilot', '96B251', 695, 'Kronograf preciz me histori te lidhur me misionet hapesinore.', 'Nje kronograf Bulova u perdor ne siperfaqen e Henes gjate Apollo 15.', 'img/o12.jpg', 12, 86, 0, 12, 'High precision quartz', 'Stainless steel', '50 m'),
('casio-g-shock-full-metal', 'Casio', (SELECT kategoriaid FROM kategorite WHERE emri='Sportive' LIMIT 1), 1, 'Casio G-Shock Full Metal', 'GMW-B5000D-1', 550, 'Ikona digjitale G-Shock ne konstruksion full metal.', 'Silueta origjinale e vitit 1983 rikthehet me lidhje Bluetooth dhe energji solare.', 'img/o28.jpg', 10, 92, 1, 10, 'Solar quartz', 'Stainless steel', '200 m'),
('frederique-constant-highlife', 'Frederique Constant', (SELECT kategoriaid FROM kategorite WHERE emri='Elegante' LIMIT 1), NULL, 'Frederique Constant Highlife', 'FC-303N4NH6B', 2250, 'Ore automatike me bracelet te integruar dhe dial globe.', 'Highlife kombinon nje identitet modern me mekanike zvicerane te arritshme.', 'img/o36.jpg', 0, 75, 0, 6, 'Automatic', 'Stainless steel', '50 m'),
('rado-captain-cook-automatic', 'Rado', (SELECT kategoriaid FROM kategorite WHERE emri='Diver' LIMIT 1), 1, 'Rado Captain Cook Automatic', 'R32505203', 2400, 'Diver retro-modern me bezel high-tech ceramic.', 'Captain Cook rikthen nje reference Rado te vitit 1962 me materiale moderne.', 'img/ora2.jpg', 9, 81, 1, 7, 'Automatic', 'Steel and ceramic', '300 m');

CREATE INDEX IF NOT EXISTS idx_orat_category ON orat (category_id);
CREATE INDEX IF NOT EXISTS idx_orat_offer ON orat (offer_id);
