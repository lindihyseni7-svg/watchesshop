<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oraid = (int)($_POST['oraid'] ?? 0);
    $emri = trim($_POST['emri'] ?? '');
    $modeli = trim($_POST['modeli'] ?? '');
    $cmimi = (float)($_POST['cmimi'] ?? 0);
    $sasia = max(1, (int)($_POST['sasia'] ?? 1));

    if ($oraid > 0 && $emri !== '' && $cmimi >= 0) {
        if (!isset($_SESSION['shporta'])) {
            $_SESSION['shporta'] = [];
        }

        $found = false;
        foreach ($_SESSION['shporta'] as &$produkt) {
            if ((int)$produkt['oraid'] === $oraid) {
                $produkt['sasia'] = (int)$produkt['sasia'] + $sasia;
                $found = true;
                break;
            }
        }
        unset($produkt);

        if (!$found) {
            $_SESSION['shporta'][] = [
                'oraid' => $oraid,
                'emri' => $emri,
                'cmimi' => $cmimi,
                'sasia' => $sasia,
                'modeli' => $modeli
            ];
        }

        $_SESSION['message'] = "Produkti u shtua ne shporte.";
    }
}

$redirect = $_SERVER['HTTP_REFERER'] ?? 'orat.php';
header('Location: ' . $redirect);
exit;
