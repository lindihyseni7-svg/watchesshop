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
