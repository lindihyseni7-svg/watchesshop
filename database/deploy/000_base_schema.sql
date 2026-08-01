-- Fresh-install schema for shared hosting before running the numbered migrations.
-- Import this first on InfinityFree when the database is empty.

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
