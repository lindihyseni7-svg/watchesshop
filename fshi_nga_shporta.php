<?php
session_start();

if (isset($_GET['indeksi'], $_SESSION['shporta'])) {
    $indeksi = (int)$_GET['indeksi'];
    if (isset($_SESSION['shporta'][$indeksi])) {
        unset($_SESSION['shporta'][$indeksi]);
        $_SESSION['shporta'] = array_values($_SESSION['shporta']);
        $_SESSION['message'] = "Produkti u largua nga shporta.";
    }
}

header('Location: shporta.php');
exit;
