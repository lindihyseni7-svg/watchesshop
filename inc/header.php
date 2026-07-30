<?php
include_once __DIR__ . "/functions.php";

$currentPage = basename($_SERVER['PHP_SELF']);
$cartItems = cartCount();

function activeNav($page, $currentPage){
    return $page === $currentPage ? ' class="active"' : '';
}
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Watches Prishtina</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.3.67/css/materialdesignicons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="oferta.css">
    <link rel="stylesheet" href="watches.css">
    <link rel="stylesheet" href="paralajmrimi.css">
    <link rel="stylesheet" href="modern.css">
</head>
<body>
    <header class="site-header">
        <nav class="site-nav container">
            <a href="index.php" class="brand" aria-label="Watches Prishtina">
                <span class="brand-mark">WP</span>
                <span>
                    <strong>Watches</strong>
                    <small>Prishtina</small>
                </span>
            </a>

            <ul class="nav-links">
                <li><a<?= activeNav('index.php', $currentPage); ?> href="index.php">Home</a></li>
                <li><a<?= activeNav('orat.php', $currentPage); ?> href="orat.php">Orat</a></li>
                <?php if(isset($_SESSION['perdoruesi'])): ?>
                    <?php if(isAdmin()): ?>
                        <li><a<?= activeNav('perdoruesit.php', $currentPage); ?> href="perdoruesit.php">Perdoruesit</a></li>
                        <li><a<?= activeNav('kategorite.php', $currentPage); ?> href="kategorite.php">Kategorite</a></li>
                        <li><a<?= activeNav('brendet.php', $currentPage); ?> href="brendet.php">Brendet</a></li>
                        <li><a<?= activeNav('ofertat.php', $currentPage); ?> href="ofertat.php">Ofertat</a></li>
                    <?php endif; ?>
                    <li><a id="logout" href="#">Log out</a></li>
                <?php else: ?>
                    <li><a<?= activeNav('login.php', $currentPage); ?> href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>

            <a class="cart-link" href="shporta.php" aria-label="Shporta">
                <span class="mdi mdi-cart-outline"></span>
                <?php if($cartItems > 0): ?>
                    <span class="cart-badge"><?= $cartItems; ?></span>
                <?php endif; ?>
            </a>
        </nav>
    </header>
