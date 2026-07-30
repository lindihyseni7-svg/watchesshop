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
