-- Portfolio demo account with read-only access to the admin panel.
-- Password: DemoAdmin2026!
INSERT INTO perdoruesit
    (emri, mbiemri, email, fjalekalimi, telefoni, nrpersonal, role)
VALUES
    ('Demo', 'Admin', 'demo.admin@watchesshop.test', '$2y$10$PWvvtEB5u9TnxqdtTyyk2uYgTARB0aoEcAjtaJmvcwfu44hJt4vhq', '+38344111444', '1000000003', 'DemoAdmin')
ON DUPLICATE KEY UPDATE
    fjalekalimi = VALUES(fjalekalimi),
    telefoni = VALUES(telefoni),
    nrpersonal = VALUES(nrpersonal),
    role = 'DemoAdmin';
