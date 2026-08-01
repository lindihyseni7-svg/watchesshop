-- Align demo catalog products with the actual local watch photography.
-- No products are deleted; each row is renamed and repriced to match its image.

INSERT IGNORE INTO brendet (emri, vitthemelimi, vendndodhja, website) VALUES
('Audemars Piguet', 1875, 'Zvicer', 'https://www.audemarspiguet.com'),
('Jacob & Co.', 1986, 'Shtetet e Bashkuara', 'https://jacobandco.com'),
('Philipp Plein', 1998, 'Zvicer', 'https://www.plein.com'),
('Diesel', 1978, 'Itali', 'https://www.diesel.com'),
('Gucci', 1921, 'Itali', 'https://www.gucci.com'),
('Alpina', 1883, 'Zvicer', 'https://www.alpinawatches.com'),
('Emporio Armani', 1981, 'Itali', 'https://www.armani.com');

UPDATE orat
SET
    slug = CASE id
        WHEN 1 THEN 'rolex-sea-dweller-black'
        WHEN 2 THEN 'audemars-piguet-royal-oak-offshore'
        WHEN 3 THEN 'jacob-co-bugatti-chiron'
        WHEN 4 THEN 'rolex-daytona-oysterflex'
        WHEN 5 THEN 'rolex-submariner-date'
        WHEN 6 THEN 'bulova-curv-chronograph-blue'
        WHEN 7 THEN 'bulova-classic-automatic-rectangular'
        WHEN 8 THEN 'philipp-plein-the-g-o-a-t-red'
        WHEN 9 THEN 'philipp-plein-hexagon-phantom'
        WHEN 10 THEN 'diesel-mega-chief-blue'
        WHEN 11 THEN 'diesel-red-iridescent'
        WHEN 12 THEN 'seiko-5-sports-black-gold'
        WHEN 13 THEN 'gucci-g-timeless-blue'
        WHEN 14 THEN 'alpina-alpiner-pink-dial'
        WHEN 15 THEN 'emporio-armani-diver-solar'
        WHEN 16 THEN 'smart-watch-silver-mesh'
        WHEN 17 THEN 'rolex-sea-dweller-vintage'
        WHEN 18 THEN 'audemars-piguet-royal-oak-silver'
        WHEN 19 THEN 'jacob-co-bugatti-crystal'
        WHEN 20 THEN 'rolex-cosmograph-daytona'
        WHEN 21 THEN 'bulova-marine-star-blue'
        WHEN 22 THEN 'bulova-sutton-rectangular'
        WHEN 23 THEN 'philipp-plein-rainbow-black'
        WHEN 24 THEN 'philipp-plein-red-crystal'
        WHEN 25 THEN 'diesel-ms9-blue'
        WHEN 26 THEN 'diesel-framed-red'
        WHEN 27 THEN 'seiko-black-limited'
        WHEN 28 THEN 'gucci-automatic-blue'
        WHEN 29 THEN 'alpina-extreme-pink'
        WHEN 30 THEN 'emporio-armani-solar-diver'
        WHEN 31 THEN 'smart-watch-industrial'
        WHEN 32 THEN 'rolex-sea-dweller-card'
        ELSE slug
    END,
    brand = CASE id
        WHEN 1 THEN 'Rolex'
        WHEN 2 THEN 'Audemars Piguet'
        WHEN 3 THEN 'Jacob & Co.'
        WHEN 4 THEN 'Rolex'
        WHEN 5 THEN 'Rolex'
        WHEN 6 THEN 'Bulova'
        WHEN 7 THEN 'Bulova'
        WHEN 8 THEN 'Philipp Plein'
        WHEN 9 THEN 'Philipp Plein'
        WHEN 10 THEN 'Diesel'
        WHEN 11 THEN 'Diesel'
        WHEN 12 THEN 'Seiko'
        WHEN 13 THEN 'Gucci'
        WHEN 14 THEN 'Alpina'
        WHEN 15 THEN 'Emporio Armani'
        WHEN 16 THEN 'Smart Watch'
        WHEN 17 THEN 'Rolex'
        WHEN 18 THEN 'Audemars Piguet'
        WHEN 19 THEN 'Jacob & Co.'
        WHEN 20 THEN 'Rolex'
        WHEN 21 THEN 'Bulova'
        WHEN 22 THEN 'Bulova'
        WHEN 23 THEN 'Philipp Plein'
        WHEN 24 THEN 'Philipp Plein'
        WHEN 25 THEN 'Diesel'
        WHEN 26 THEN 'Diesel'
        WHEN 27 THEN 'Seiko'
        WHEN 28 THEN 'Gucci'
        WHEN 29 THEN 'Alpina'
        WHEN 30 THEN 'Emporio Armani'
        WHEN 31 THEN 'Smart Watch'
        WHEN 32 THEN 'Rolex'
        ELSE brand
    END,
    emri = CASE id
        WHEN 1 THEN 'Rolex Sea-Dweller Black'
        WHEN 2 THEN 'Audemars Piguet Royal Oak Offshore'
        WHEN 3 THEN 'Jacob & Co. Bugatti Chiron'
        WHEN 4 THEN 'Rolex Daytona Oysterflex'
        WHEN 5 THEN 'Rolex Submariner Date'
        WHEN 6 THEN 'Bulova CURV Chronograph Blue'
        WHEN 7 THEN 'Bulova Classic Automatic Rectangular'
        WHEN 8 THEN 'Philipp Plein The G.O.A.T. Red'
        WHEN 9 THEN 'Philipp Plein Hexagon Phantom'
        WHEN 10 THEN 'Diesel Mega Chief Blue'
        WHEN 11 THEN 'Diesel Red Iridescent'
        WHEN 12 THEN 'Seiko 5 Sports Black Gold'
        WHEN 13 THEN 'Gucci G-Timeless Blue'
        WHEN 14 THEN 'Alpina Alpiner Pink Dial'
        WHEN 15 THEN 'Emporio Armani Diver Solar'
        WHEN 16 THEN 'Smart Watch Silver Mesh'
        WHEN 17 THEN 'Rolex Sea-Dweller Vintage'
        WHEN 18 THEN 'Audemars Piguet Royal Oak Silver'
        WHEN 19 THEN 'Jacob & Co. Bugatti Crystal'
        WHEN 20 THEN 'Rolex Cosmograph Daytona'
        WHEN 21 THEN 'Bulova Marine Star Blue'
        WHEN 22 THEN 'Bulova Sutton Rectangular'
        WHEN 23 THEN 'Philipp Plein Rainbow Black'
        WHEN 24 THEN 'Philipp Plein Red Crystal'
        WHEN 25 THEN 'Diesel MS9 Blue'
        WHEN 26 THEN 'Diesel Framed Red'
        WHEN 27 THEN 'Seiko Black Limited'
        WHEN 28 THEN 'Gucci Automatic Blue'
        WHEN 29 THEN 'Alpina Extreme Pink'
        WHEN 30 THEN 'Emporio Armani Solar Diver'
        WHEN 31 THEN 'Smart Watch Industrial'
        WHEN 32 THEN 'Rolex Sea-Dweller Card'
        ELSE emri
    END,
    modeli = CASE id
        WHEN 1 THEN 'Sea-Dweller 4000'
        WHEN 2 THEN 'Royal Oak Offshore'
        WHEN 3 THEN 'Bugatti Chiron Tourbillon'
        WHEN 4 THEN 'Daytona Oysterflex'
        WHEN 5 THEN 'Submariner Date'
        WHEN 6 THEN 'CURV 98A162'
        WHEN 7 THEN 'Sutton Automatic 96A269'
        WHEN 8 THEN 'PWBAA0421'
        WHEN 9 THEN 'Hexagon Rainbow'
        WHEN 10 THEN 'DZ4478'
        WHEN 11 THEN 'DZ4526'
        WHEN 12 THEN 'SRPH80K1'
        WHEN 13 THEN 'YA1264032'
        WHEN 14 THEN 'Alpiner Extreme'
        WHEN 15 THEN 'AR11518 Solar'
        WHEN 16 THEN 'Silver Mesh Edition'
        WHEN 17 THEN 'Sea-Dweller 16600'
        WHEN 18 THEN 'Royal Oak Steel'
        WHEN 19 THEN 'Bugatti Sapphire'
        WHEN 20 THEN 'Daytona 116500'
        WHEN 21 THEN 'Marine Star Chronograph'
        WHEN 22 THEN 'Sutton Open Heart'
        WHEN 23 THEN 'Plein Sport Phantom'
        WHEN 24 THEN 'The G.O.A.T. Crystal'
        WHEN 25 THEN 'Mega Chief Blue'
        WHEN 26 THEN 'Red Iridescent'
        WHEN 27 THEN 'Seiko 5 Limited'
        WHEN 28 THEN 'G-Timeless Automatic'
        WHEN 29 THEN 'Alpiner Extreme Quartz'
        WHEN 30 THEN 'Diver Chronograph Solar'
        WHEN 31 THEN 'Rugged Smart Edition'
        WHEN 32 THEN 'Sea-Dweller Macro'
        ELSE modeli
    END,
    image = CASE id
        WHEN 1 THEN 'img/o34.jpg'
        WHEN 2 THEN 'img/o6.jpg'
        WHEN 3 THEN 'img/o2.jpg'
        WHEN 4 THEN 'img/o1.jpg'
        WHEN 5 THEN 'img/o0.jpg'
        WHEN 6 THEN 'img/bulova-chronograph-card.jpg'
        WHEN 7 THEN 'img/bulova-rectangular-card.jpg'
        WHEN 8 THEN 'img/philipp-plein-red-card.jpg'
        WHEN 9 THEN 'img/philipp-plein-black-card.webp'
        WHEN 10 THEN 'img/diesel-blue-card.webp'
        WHEN 11 THEN 'img/diesel-red-card.jpg'
        WHEN 12 THEN 'img/seiko-black-card.webp'
        WHEN 13 THEN 'img/gucci-blue-card.jpg'
        WHEN 14 THEN 'img/alpina-pink-card.webp'
        WHEN 15 THEN 'img/emporio-armani-diver-card.jpg'
        WHEN 16 THEN 'img/smart-watch-card.jpg'
        WHEN 17 THEN 'img/rolex-sea-dweller-card.webp'
        WHEN 18 THEN 'img/o6.jpg'
        WHEN 19 THEN 'img/o2.jpg'
        WHEN 20 THEN 'img/o1.jpg'
        WHEN 21 THEN 'img/w-card-bulova.jpg'
        WHEN 22 THEN 'img/w-card-bulova2.jpg'
        WHEN 23 THEN 'img/wcard-philipplein-2.webp'
        WHEN 24 THEN 'img/wcard-philipplein.jpg'
        WHEN 25 THEN 'img/wcarddiesel.webp'
        WHEN 26 THEN 'img/wcard-diesel.jpg'
        WHEN 27 THEN 'img/wcard-seiko.webp'
        WHEN 28 THEN 'img/wcard-gucci.jpg'
        WHEN 29 THEN 'img/Alpina-watch-card.webp'
        WHEN 30 THEN 'img/Watch-card-emporioarmani.jpg'
        WHEN 31 THEN 'img/smart-watchwcard.jpg'
        WHEN 32 THEN 'img/ROLEX-wcard.webp'
        ELSE image
    END,
    cmimi = CASE id
        WHEN 1 THEN 9800 WHEN 2 THEN 28500 WHEN 3 THEN 420000 WHEN 4 THEN 26500 WHEN 5 THEN 9100
        WHEN 6 THEN 620 WHEN 7 THEN 540 WHEN 8 THEN 890 WHEN 9 THEN 1150 WHEN 10 THEN 320 WHEN 11 THEN 360
        WHEN 12 THEN 520 WHEN 13 THEN 1450 WHEN 14 THEN 1850 WHEN 15 THEN 430 WHEN 16 THEN 180
        WHEN 17 THEN 8750 WHEN 18 THEN 24800 WHEN 19 THEN 390000 WHEN 20 THEN 23800
        WHEN 21 THEN 590 WHEN 22 THEN 520 WHEN 23 THEN 1050 WHEN 24 THEN 940 WHEN 25 THEN 295 WHEN 26 THEN 340
        WHEN 27 THEN 480 WHEN 28 THEN 1390 WHEN 29 THEN 1780 WHEN 30 THEN 420 WHEN 31 THEN 210 WHEN 32 THEN 9400
        ELSE cmimi
    END,
    discount_percent = CASE id
        WHEN 1 THEN 7 WHEN 2 THEN 5 WHEN 3 THEN 4 WHEN 4 THEN 6 WHEN 5 THEN 8
        WHEN 6 THEN 14 WHEN 7 THEN 13 WHEN 8 THEN 18 WHEN 9 THEN 16 WHEN 10 THEN 20 WHEN 11 THEN 19
        WHEN 12 THEN 12 WHEN 13 THEN 10 WHEN 14 THEN 11 WHEN 15 THEN 15 WHEN 16 THEN 22
        WHEN 17 THEN 9 WHEN 18 THEN 6 WHEN 19 THEN 5 WHEN 20 THEN 7
        WHEN 21 THEN 15 WHEN 22 THEN 14 WHEN 23 THEN 17 WHEN 24 THEN 18 WHEN 25 THEN 21 WHEN 26 THEN 20
        WHEN 27 THEN 13 WHEN 28 THEN 11 WHEN 29 THEN 12 WHEN 30 THEN 16 WHEN 31 THEN 22 WHEN 32 THEN 8
        ELSE discount_percent
    END,
    movement = CASE
        WHEN id IN (1,2,3,4,5,17,18,19,20,32) THEN 'Automatic / luxury mechanical'
        WHEN id IN (6,7,12,14,21,22,27,29) THEN 'Automatic'
        WHEN id IN (8,9,10,11,13,15,16,23,24,25,26,28,30,31) THEN 'Quartz'
        ELSE movement
    END,
    material = CASE
        WHEN id IN (2,18) THEN 'Stainless steel integrated bracelet'
        WHEN id IN (3,19) THEN 'Sapphire crystal case and rubber strap'
        WHEN id IN (8,24) THEN 'Rose-tone steel and silicone'
        WHEN id IN (9,23) THEN 'Black IP steel'
        WHEN id IN (16,31) THEN 'Aluminium case and mesh strap'
        ELSE 'Stainless steel'
    END,
    water_resistance = CASE
        WHEN id IN (1,5,17,32) THEN '300 m'
        WHEN id IN (2,4,18,20) THEN '100 m'
        WHEN id IN (10,11,15,25,26,30) THEN '50 m'
        WHEN id IN (16,31) THEN 'IP rated'
        ELSE '30-100 m'
    END,
    popularity = CASE
        WHEN id IN (3,19) THEN 99
        WHEN id IN (1,2,4,5,17,18,20,32) THEN 94
        WHEN id IN (8,9,13,14,15,23,24,28,29,30) THEN 84
        ELSE 78
    END,
    is_new = CASE WHEN id IN (2,3,9,14,16,18,19,23,29,31) THEN 1 ELSE 0 END,
    stock = CASE
        WHEN id IN (3,19) THEN 1
        WHEN id IN (1,2,4,5,17,18,20,32) THEN 2
        WHEN id IN (8,9,13,14,15,23,24,28,29,30) THEN 5
        ELSE 8
    END,
    pershkrimi = CASE
        WHEN id IN (1,17,32) THEN 'Rolex Sea-Dweller me dial te zi, bezel profesional dhe pamje makro qe tregon qarte detajet e kases, indeksat dhe konstruksionin e fortesuar per uje.'
        WHEN id IN (2,18) THEN 'Audemars Piguet Royal Oak Offshore me forme oktagonale, prezence sportive luksoze dhe finish metalik qe perputhet me foton e ores premium.'
        WHEN id IN (3,19) THEN 'Jacob & Co. Bugatti Chiron Tourbillon me arkitekture ekstremisht komplekse, ngjyra sportive dhe karakter hypercar per koleksionues.'
        WHEN id IN (4,20) THEN 'Rolex Daytona me identitet motorsporti, bezel tachymeter dhe pamje sportive luksoze qe perputhet me foton e card-it.'
        WHEN id = 5 THEN 'Rolex Submariner Date me profil diver, dial te zi dhe prezence klasike; produkti mban vleren vizuale te fotos kryesore ne card.'
        WHEN id IN (6,21) THEN 'Bulova chronograph me dial blu dhe tonalitet rose-gold, zgjedhje elegante per klient qe do pamje klasike me energji sportive.'
        WHEN id IN (7,22) THEN 'Bulova rectangular automatic me rrip lekure kafe, open-heart dhe dizajn dress qe perputhet me foton vertikale te produktit.'
        WHEN id IN (8,24) THEN 'Philipp Plein me rrip te kuq dhe gur dekorativ, ore fashion statement per klient qe kerkon ngjyre, shkelqim dhe prezence.'
        WHEN id IN (9,23) THEN 'Philipp Plein black rainbow me bezel te mbushur me kristale shumengjyreshe dhe trup te zi per pamje moderne e te guximshme.'
        WHEN id IN (10,25) THEN 'Diesel me dial blu, kronograf dhe kase te madhe metalike, perfekt per stil urban dhe prezence te forte ne dore.'
        WHEN id IN (11,26) THEN 'Diesel red iridescent me tonalitet te kuq te thelle dhe forme agresive, ore fashion per pamje te guximshme.'
        WHEN id IN (12,27) THEN 'Seiko 5 Sports me dial te zi, detaje gold dhe mekanizem automatik, zgjedhje e besueshme japoneze me karakter sportiv.'
        WHEN id IN (13,28) THEN 'Gucci automatic me dial blu dhe bracelet metalik, kombinim i modes italiane me pamje klasike premium.'
        WHEN id IN (14,29) THEN 'Alpina me dial rozhe te teksturuar dhe kase sportive-elegante, e pershtatshme per klient qe do ngjyre te rafinuar.'
        WHEN id IN (15,30) THEN 'Emporio Armani diver solar me dial blu-portokalli dhe rrip sportiv, ore moderne per perdorim aktiv dhe stil casual premium.'
        WHEN id IN (16,31) THEN 'Smart watch me kase argjendi dhe rrip mesh, i fotografuar ne sfond te bardhe per pamje te paster moderne.'
        ELSE pershkrimi
    END,
    historia = CASE
        WHEN brand = 'Rolex' THEN 'Rolex njihet per dizajn te qendrueshem, precision dhe ruajtje vlere. Ky model ne katalog eshte vendosur per te dhene sinjal premium ne portfolio.'
        WHEN brand = 'Audemars Piguet' THEN 'Audemars Piguet lidhet me dizajnin Royal Oak dhe orat luksoze sportive me finish te larte.'
        WHEN brand = 'Jacob & Co.' THEN 'Jacob & Co. eshte marke e njohur per mekanizma teatrale, gur dekorativ dhe ora qe duken si objekte arti.'
        WHEN brand = 'Bulova' THEN 'Bulova ka histori te gjate ne inovacion dhe dizajn amerikan, me modele qe shkojne nga dress deri te kronografet.'
        WHEN brand = 'Philipp Plein' THEN 'Philipp Plein fokusohet ne aksesore fashion me prezence te forte dhe detaje dekorative.'
        WHEN brand = 'Diesel' THEN 'Diesel sjell ora urbane me kasa te medha, ngjyra te forta dhe identitet industrial.'
        WHEN brand = 'Seiko' THEN 'Seiko eshte zgjedhje japoneze e besueshme per mekanizma automatike dhe dizajn praktik.'
        WHEN brand = 'Gucci' THEN 'Gucci bashkon identitetin e modes italiane me forma klasike te ores se dores.'
        WHEN brand = 'Alpina' THEN 'Alpina njihet per fryme sportive zvicerane dhe modele te qendrueshme me detaje moderne.'
        WHEN brand = 'Emporio Armani' THEN 'Emporio Armani ofron ora fashion me pamje te paster dhe cmim te arritshem premium.'
        ELSE historia
    END
WHERE id BETWEEN 1 AND 32;
