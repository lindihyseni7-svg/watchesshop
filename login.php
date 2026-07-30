<?php
include 'inc/functions.php';

if(isset($_POST['login'])){
    login($_POST['email'], $_POST['fjalekalimi']);
}
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Watches Prishtina</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modern.css">
</head>
<body class="auth-page">
    <section class="auth-card">
        <h1>Hyr ne llogari</h1>
        <p>Menaxho shporten ose panelin admin sipas rolit tend.</p>

        <?php if(isset($_SESSION['message'])): ?>
            <div id="message" style="width:100%;margin:0 0 18px;"><?= e($_SESSION['message']); ?></div>
        <?php endif; ?>

        <form method="POST" id="loginv">
            <div class="user-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="user-box">
                <label for="fjalekalimi">Fjalekalimi</label>
                <input type="password" id="fjalekalimi" name="fjalekalimi" required>
            </div>
            <input type="submit" id="login" name="login" value="Login">
        </form>

        <div class="auth-link">
            Nuk keni llogari? <a href="regjistrohu.php">Regjistrohu</a>
        </div>
    </section>

    <?php include 'inc/validimi.php'; ?>
</body>
</html>
