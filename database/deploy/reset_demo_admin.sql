-- Use this on hosting only if deploy-check says the demo admin is missing
-- or the demo admin password is not valid.
INSERT INTO perdoruesit
    (emri, mbiemri, email, fjalekalimi, telefoni, nrpersonal, role)
VALUES
    ('Admin', 'Watches', 'admin@watchesshop.test', '$2y$10$K9p9zPezMmCt5mtl3YhZI.YIjUl6GN3DGGFlDbjGzrS.Z8hJoD8A.', '+38344111222', '1000000001', 'Administrator')
ON DUPLICATE KEY UPDATE
    fjalekalimi = VALUES(fjalekalimi),
    role = 'Administrator';
