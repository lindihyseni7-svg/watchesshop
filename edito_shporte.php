<?php
session_start();

if (isset($_GET['indeksi'], $_POST['sasia'], $_SESSION['shporta'])) {
    $indeksi = (int)$_GET['indeksi'];
    $sasia_re = max(1, (int)$_POST['sasia']);

    if (isset($_SESSION['shporta'][$indeksi])) {
        $_SESSION['shporta'][$indeksi]['sasia'] = $sasia_re;
        $_SESSION['message'] = "Shporta u perditesua.";
    }
}

header('Location: shporta.php');
exit;
