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
