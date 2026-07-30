<?php
include 'inc/functions.php';

if (isset($_POST['regjistrohu'])) {
    regjistroPerdorues(
        $_POST['emri'],
        $_POST['mbiemri'],
        $_POST['email'],
        $_POST['telefoni'],
        $_POST['nrpersonal'],
        'Perdorues',
        $_POST['fjalekalimi']
    );
}
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Regjistrohu - Watches Prishtina</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modern.css">
</head>
<body class="auth-page">
    <section class="auth-card">
        <h1>Krijo llogari</h1>
        <p>Regjistrimi publik krijon llogari klienti. Rolet admin menaxhohen nga paneli.</p>

        <form action="#" method="POST" id="regjistrohu">
            <div class="auth-field">
                <label for="emri">Emri</label>
                <input type="text" id="emri" name="emri" required>
            </div>
            <div class="auth-field">
                <label for="mbiemri">Mbiemri</label>
                <input type="text" id="mbiemri" name="mbiemri" required>
            </div>
            <div class="auth-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="auth-field">
                <label for="telefoni">Telefoni</label>
                <input type="tel" id="telefoni" name="telefoni" required>
            </div>
            <div class="auth-field">
                <label for="nrpersonal">Numri personal</label>
                <input type="text" id="nrpersonal" name="nrpersonal" required>
            </div>
            <div class="auth-field">
                <label for="fjalekalimi">Fjalekalimi</label>
                <input type="password" id="fjalekalimi" name="fjalekalimi" required>
            </div>
            <input type="submit" name="regjistrohu" value="Regjistrohu">
        </form>

        <div class="auth-link">
            Keni llogari? <a href="login.php">Login</a>
        </div>
    </section>

    <?php include 'inc/validimi.php'; ?>
</body>
</html>
