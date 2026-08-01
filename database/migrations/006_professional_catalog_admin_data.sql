-- Professional demo data pass: richer catalog copy, realistic discount spread,
-- newsletter source tracking and dedicated sell-your-watch requests.

ALTER TABLE newsletter_subscribers
    ADD COLUMN IF NOT EXISTS source VARCHAR(80) NOT NULL DEFAULT 'footer' AFTER is_active;

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

UPDATE orat
SET
    cmimi = CASE slug
        WHEN 'rolex-submariner-116610' THEN 8950
        WHEN 'casio-edifice-efr-556' THEN 210
        WHEN 'rolex-daytona-116500' THEN 15800
        WHEN 'casio-g-shock-ga-2100' THEN 135
        WHEN 'rolex-datejust-126200' THEN 7450
        WHEN 'casio-vintage-a168wa' THEN 65
        WHEN 'omega-speedmaster-moonwatch' THEN 7350
        WHEN 'omega-seamaster-diver-300m' THEN 5650
        WHEN 'tissot-prx-powermatic-80' THEN 825
        WHEN 'tissot-gentleman-silicium' THEN 875
        WHEN 'seiko-prospex-1968' THEN 1190
        WHEN 'seiko-presage-sharp-edged' THEN 990
        WHEN 'tag-heuer-carrera-chronograph' THEN 6200
        WHEN 'tag-heuer-aquaracer-300' THEN 3250
        WHEN 'longines-spirit-zulu-time' THEN 3050
        WHEN 'longines-master-collection' THEN 2380
        WHEN 'citizen-tsuyosa-blue' THEN 420
        WHEN 'hamilton-khaki-field-auto' THEN 720
        WHEN 'cartier-santos-medium' THEN 7650
        WHEN 'breitling-navitimer-b01' THEN 8900
        WHEN 'orient-bambino-version-8' THEN 360
        WHEN 'mido-ocean-star-200c' THEN 1180
        WHEN 'tudor-black-bay-58' THEN 3980
        WHEN 'tudor-pelagos-39' THEN 4450
        WHEN 'iwc-portugieser-automatic-40' THEN 7100
        WHEN 'panerai-luminor-marina' THEN 7850
        WHEN 'nomos-tangente-38' THEN 2290
        WHEN 'zenith-chronomaster-sport' THEN 10400
        WHEN 'bulova-lunar-pilot' THEN 650
        WHEN 'casio-g-shock-full-metal' THEN 520
        WHEN 'frederique-constant-highlife' THEN 2100
        WHEN 'rado-captain-cook-automatic' THEN 2320
        ELSE cmimi
    END,
    discount_percent = CASE slug
        WHEN 'rolex-submariner-116610' THEN 6
        WHEN 'casio-edifice-efr-556' THEN 18
        WHEN 'rolex-daytona-116500' THEN 4
        WHEN 'casio-g-shock-ga-2100' THEN 16
        WHEN 'rolex-datejust-126200' THEN 7
        WHEN 'casio-vintage-a168wa' THEN 22
        WHEN 'omega-speedmaster-moonwatch' THEN 8
        WHEN 'omega-seamaster-diver-300m' THEN 11
        WHEN 'tissot-prx-powermatic-80' THEN 14
        WHEN 'tissot-gentleman-silicium' THEN 10
        WHEN 'seiko-prospex-1968' THEN 15
        WHEN 'seiko-presage-sharp-edged' THEN 12
        WHEN 'tag-heuer-carrera-chronograph' THEN 9
        WHEN 'tag-heuer-aquaracer-300' THEN 13
        WHEN 'longines-spirit-zulu-time' THEN 8
        WHEN 'longines-master-collection' THEN 16
        WHEN 'citizen-tsuyosa-blue' THEN 20
        WHEN 'hamilton-khaki-field-auto' THEN 12
        WHEN 'cartier-santos-medium' THEN 5
        WHEN 'breitling-navitimer-b01' THEN 9
        WHEN 'orient-bambino-version-8' THEN 18
        WHEN 'mido-ocean-star-200c' THEN 14
        WHEN 'tudor-black-bay-58' THEN 6
        WHEN 'tudor-pelagos-39' THEN 7
        WHEN 'iwc-portugieser-automatic-40' THEN 6
        WHEN 'panerai-luminor-marina' THEN 8
        WHEN 'nomos-tangente-38' THEN 11
        WHEN 'zenith-chronomaster-sport' THEN 5
        WHEN 'bulova-lunar-pilot' THEN 17
        WHEN 'casio-g-shock-full-metal' THEN 15
        WHEN 'frederique-constant-highlife' THEN 13
        WHEN 'rado-captain-cook-automatic' THEN 12
        ELSE discount_percent
    END,
    pershkrimi = CASE slug
        WHEN 'rolex-submariner-116610' THEN 'Diver premium me bezel qeramike, dial te zi shume te lexueshem dhe konstruksion Oystersteel per perdorim serioz ne uje dhe perditshmeri luksoze.'
        WHEN 'casio-edifice-efr-556' THEN 'Kronograf sportiv quartz me dial dinamik, kase celiku dhe prezence moderne per klient qe kerkon pamje teknike pa mirembajtje te komplikuar.'
        WHEN 'rolex-daytona-116500' THEN 'Kronograf motorsporti me tachymeter, totalizues te balancuar dhe karakter koleksionues per ata qe duan nje ikone sportive te nivelit te larte.'
        WHEN 'casio-g-shock-ga-2100' THEN 'Ore ana-digjitale rezistente ndaj goditjeve, e lehte dhe urbane, e pershtatshme per perdorim aktiv dhe stil minimal modern.'
        WHEN 'rolex-datejust-126200' THEN 'Datejust klasik me proporcion elegant, dritare date dhe kase celiku qe funksionon natyrshem nga zyra deri ne evente.'
        WHEN 'casio-vintage-a168wa' THEN 'Ikone digjitale retro me alarm, kronometer dhe bracelet metalik te lehte; zgjedhje praktike dhe stilistike per perdorim te perditshem.'
        WHEN 'omega-speedmaster-moonwatch' THEN 'Kronograf mekanik me dial te zi, tachymeter dhe identitet te lidhur me historine hapesinore; nje instrument me peshe koleksionuese.'
        WHEN 'omega-seamaster-diver-300m' THEN 'Diver zviceran me valvula helium, dial qeramike dhe rezistence 300 m, i ndertuar per sport, udhetim dhe veshje premium.'
        WHEN 'tissot-prx-powermatic-80' THEN 'Sport elegance me bracelet te integruar, dial me teksture dhe rezerve 80 ore; nje nga vlerat me te forta ne segmentin zviceran.'
        WHEN 'tissot-gentleman-silicium' THEN 'Ore automatike versatile me pamje te paster, mekanizem me silicium dhe profil qe i pershtatet punes, darkes dhe perdorimit ditor.'
        WHEN 'seiko-prospex-1968' THEN 'Diver japonez i forte, me lexueshmeri te larte dhe forme profesionale, ideal per klient qe do besueshmeri dhe karakter teknik.'
        WHEN 'seiko-presage-sharp-edged' THEN 'Ore elegante automatike me dial te teksturuar japonez dhe linja te prera qarte per nje prezence moderne, por te matur.'
        WHEN 'tag-heuer-carrera-chronograph' THEN 'Kronograf racing me dial panda, xham dome dhe identitet sportiv; i bere per klient qe pelqen shpejtesine dhe precizionin.'
        WHEN 'tag-heuer-aquaracer-300' THEN 'Aquaracer teknik me bezel qeramike, bracelet solid dhe rezistence 300 m per nje diver modern me energji sportive.'
        WHEN 'longines-spirit-zulu-time' THEN 'GMT i rafinuar me dy zona kohore, i pershtatshem per udhetime dhe per klient qe do funksion real pa humbur elegance.'
        WHEN 'longines-master-collection' THEN 'Dress watch klasik me dial te paster dhe mekanizem automatik, zgjedhje e rafinuar per evente dhe veshje formale.'
        WHEN 'citizen-tsuyosa-blue' THEN 'Ore automatike japoneze me dial te kalter, bracelet te integruar dhe cmim te arritshem per nje pamje te fresket dhe moderne.'
        WHEN 'hamilton-khaki-field-auto' THEN 'Field watch i lexueshem dhe i forte, me frymezim ushtarak dhe mekanizem automatik per perdorim praktik cdo dite.'
        WHEN 'cartier-santos-medium' THEN 'Ikone katrore e Cartier me bracelet te integruar dhe prezence elegante; nje ore luksi qe lexohet menjehere edhe pa logo te madhe.'
        WHEN 'breitling-navitimer-b01' THEN 'Kronograf aviacioni me slide rule, dial kompleks dhe mekanizem B01; zgjedhje per koleksionues qe duan histori dhe funksion.'
        WHEN 'orient-bambino-version-8' THEN 'Dress watch automatik me xham dome dhe dial te ngrohte, perfekt si ore e pare mekanike me pamje serioze.'
        WHEN 'mido-ocean-star-200c' THEN 'Diver zviceran me qeramike, rezerve te gjate energjie dhe konstruksion solid per vlere te forte ne segmentin sportiv.'
        WHEN 'tudor-black-bay-58' THEN 'Diver me proporcion vintage, mekanizem manufacture dhe identitet Tudor te qarte; kompakt, i balancuar dhe shume i kerkuar.'
        WHEN 'tudor-pelagos-39' THEN 'Diver prej titani me peshe te lehte, karakter profesional dhe madhesi praktike per perdorim ditor.'
        WHEN 'iwc-portugieser-automatic-40' THEN 'Dress watch i madh ne karakter, por i paster ne dizajn, me small seconds dhe fryme instrumenti detar.'
        WHEN 'panerai-luminor-marina' THEN 'Ore me kase te fuqishme cushion dhe mbrojtes kurore karakteristik, per klient qe do prezence italiane dhe ADN detare.'
        WHEN 'nomos-tangente-38' THEN 'Minimalizem gjerman Bauhaus me mekanizem manual, dial te paster dhe profil te holle per shije te qete e intelektuale.'
        WHEN 'zenith-chronomaster-sport' THEN 'Kronograf high-beat El Primero me lexim preciz dhe identitet sportiv luksoz per entuziaste te mekanikes.'
        WHEN 'bulova-lunar-pilot' THEN 'Kronograf me precizion te larte quartz dhe histori hapesinore, nje alternative serioze me karakter te forte.'
        WHEN 'casio-g-shock-full-metal' THEN 'G-Shock ikonike ne konstruksion full metal, me energji solare dhe funksione moderne per rezistence me pamje premium.'
        WHEN 'frederique-constant-highlife' THEN 'Ore zvicerane me bracelet te integruar dhe dial globe, e pozicionuar per klient qe do luks te matur dhe cmim racional.'
        WHEN 'rado-captain-cook-automatic' THEN 'Diver retro-modern me bezel qeramike dhe stil te vecante, i balancuar mes trashegimise dhe materialeve moderne.'
        ELSE pershkrimi
    END,
    historia = CASE slug
        WHEN 'rolex-submariner-116610' THEN 'Submariner eshte nje nga orat diver me te njohura ne bote. Ky model ruan ADN-ne instrumentale te Rolex dhe e sjell me materiale moderne.'
        WHEN 'casio-edifice-efr-556' THEN 'Edifice perfaqeson anen sportive te Casio-s, me inspirim nga makina, shpejtesia dhe instrumentet me funksion te qarte.'
        WHEN 'rolex-daytona-116500' THEN 'Daytona lidhet me garat automobilistike dhe mbetet nje nga kronografet me te deshiruar nga koleksionuesit.'
        WHEN 'casio-g-shock-ga-2100' THEN 'GA-2100 mori vemendje per formen oktagonale dhe profilin e holle, duke e bere G-Shock me te lehte per perdorim urban.'
        WHEN 'rolex-datejust-126200' THEN 'Datejust eshte formula klasike e Rolex: date, mekanizem automatik dhe pamje qe nuk del nga moda.'
        ELSE 'Ky model eshte zgjedhur per kombinimin e dizajnit, reputacionit te markes, materialeve dhe vleres qe ofron ne segmentin e vet.'
    END
WHERE slug IN (
    'rolex-submariner-116610','casio-edifice-efr-556','rolex-daytona-116500','casio-g-shock-ga-2100',
    'rolex-datejust-126200','casio-vintage-a168wa','omega-speedmaster-moonwatch','omega-seamaster-diver-300m',
    'tissot-prx-powermatic-80','tissot-gentleman-silicium','seiko-prospex-1968','seiko-presage-sharp-edged',
    'tag-heuer-carrera-chronograph','tag-heuer-aquaracer-300','longines-spirit-zulu-time','longines-master-collection',
    'citizen-tsuyosa-blue','hamilton-khaki-field-auto','cartier-santos-medium','breitling-navitimer-b01',
    'orient-bambino-version-8','mido-ocean-star-200c','tudor-black-bay-58','tudor-pelagos-39',
    'iwc-portugieser-automatic-40','panerai-luminor-marina','nomos-tangente-38','zenith-chronomaster-sport',
    'bulova-lunar-pilot','casio-g-shock-full-metal','frederique-constant-highlife','rado-captain-cook-automatic'
);
