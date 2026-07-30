<?php
include "inc/functions.php";
requireAdmin();
include "inc/header.php";
include "inc/slide.php";
?>

<?php if(isset($_SESSION['message'])): ?>
    <div id="message"><?= e($_SESSION['message']); ?></div>
<?php endif; ?>

<main class="container admin-page">
    <div class="admin-header">
        <div>
            <p class="eyebrow">Admin</p>
            <h1>Kategorite</h1>
            <p>Organizo koleksionet dhe kostot bazike te kategorive.</p>
        </div>
        <a href="shto_modifiko_kategori.php" id="add_entity"><i class="fas fa-plus"></i> Shto kategori</a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Emri</th>
                <th>Pershkrimi</th>
                <th>Kostoja</th>
                <th>Modifiko</th>
                <th>Fshij</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $kategorit = merrKategorit();
            while ($kategoria = mysqli_fetch_assoc($kategorit)):
                $kategoriaid = $kategoria['kategoriaid'];
            ?>
                <tr>
                    <td><?= e($kategoria['emri']); ?></td>
                    <td><?= e($kategoria['pershkrimi']); ?></td>
                    <td>$<?= money($kategoria['kostoja']); ?></td>
                    <td><a href="shto_modifiko_kategori.php?kid=<?= (int)$kategoriaid; ?>"><i class="fas fa-edit"></i></a></td>
                    <td><a href="fshijkategori.php?kid=<?= (int)$kategoriaid; ?>" onclick="return confirm('A jeni i sigurt?');"><i class="far fa-trash-alt"></i></a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php include 'inc/footer.php'; ?>
