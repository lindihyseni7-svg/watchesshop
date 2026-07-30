<?php
include 'inc/header.php';

if (isset($_POST['blej']) && !empty($_SESSION['shporta'])) {
    unset($_SESSION['shporta']);
    $_SESSION['message'] = "Porosia u pranua. Faleminderit!";
    header("Location: shporta.php");
    exit;
}

$cart = $_SESSION['shporta'] ?? [];
$totaliShporta = 0;
foreach ($cart as $produkt) {
    $totaliShporta += (float)$produkt['cmimi'] * (int)$produkt['sasia'];
}
?>

<?php if(isset($_SESSION['message'])): ?>
    <div id="message"><?= e($_SESSION['message']); ?></div>
<?php endif; ?>

<main class="container">
    <section class="cart-panel">
        <div class="admin-header">
            <div>
                <p class="eyebrow">Checkout</p>
                <h1>Shporta</h1>
                <p>Perditeso sasite ose largo produktet para porosise.</p>
            </div>
            <a class="button secondary" href="orat.php"><i class="mdi mdi-arrow-left"></i> Vazhdo blerjen</a>
        </div>

        <?php if (!empty($cart)): ?>
            <?php foreach ($cart as $indeksi => $produkt): ?>
                <?php $totali = (float)$produkt['cmimi'] * (int)$produkt['sasia']; ?>
                <article class="cart-item">
                    <div>
                        <h3><?= e($produkt['emri']); ?></h3>
                        <p>Model: <?= e($produkt['modeli']); ?> · $<?= money($produkt['cmimi']); ?> secila</p>
                    </div>

                    <form method="post" action="edito_shporte.php?indeksi=<?= (int)$indeksi; ?>" class="quantity-row">
                        <label for="sasia-<?= (int)$indeksi; ?>">Sasia</label>
                        <input id="sasia-<?= (int)$indeksi; ?>" type="number" name="sasia" value="<?= e($produkt['sasia']); ?>" min="1" class="quantity-input">
                        <button type="submit" class="button secondary"><i class="mdi mdi-refresh"></i></button>
                    </form>

                    <div>
                        <strong>$<?= money($totali); ?></strong>
                        <a class="button danger" href="fshi_nga_shporta.php?indeksi=<?= (int)$indeksi; ?>"><i class="mdi mdi-trash-can-outline"></i></a>
                    </div>
                </article>
            <?php endforeach; ?>

            <div class="cart-total">
                <span>Totali</span>
                <span>$<?= money($totaliShporta); ?></span>
            </div>

            <form method="post" action="shporta.php" class="cart-actions">
                <button type="submit" name="blej" class="button"><i class="mdi mdi-check-circle-outline"></i> Blej tani</button>
                <a class="button secondary" href="orat.php">Shto produkte tjera</a>
            </form>
        <?php else: ?>
            <div class="empty-state">
                <h2>Shporta eshte bosh</h2>
                <p>Zgjidh nje ore nga katalogu dhe ajo do te shfaqet ketu.</p>
                <a class="button" href="orat.php">Shfleto orat</a>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php include 'inc/footer.php'; ?>
