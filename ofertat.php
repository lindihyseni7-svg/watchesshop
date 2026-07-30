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
            <h1>Ofertat</h1>
            <p>Kontrollo zbritjet aktive dhe datat e fushatave.</p>
        </div>
        <a href="shto_modifiko_ofert.php" id="add_entity"><i class="fas fa-plus"></i> Shto oferte</a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Emri</th>
                <th>Zbritja</th>
                <th>Fillimi</th>
                <th>Skadimi</th>
                <th>Modifiko</th>
                <th>Fshij</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ofertat = merrOfertat();
            while ($oferta = mysqli_fetch_assoc($ofertat)):
                $ofertaid = $oferta['ofertaid'];
            ?>
                <tr>
                    <td><?= e($oferta['emriofertes']); ?></td>
                    <td><?= e($oferta['zbritja']); ?>%</td>
                    <td><?= e($oferta['datafillimit']); ?></td>
                    <td><?= e($oferta['dataskadimit']); ?></td>
                    <td><a href="shto_modifiko_ofert.php?ofertaid=<?= (int)$ofertaid; ?>"><i class="fas fa-edit"></i></a></td>
                    <td><a href="fshijofert.php?ofertaid=<?= (int)$ofertaid; ?>" onclick="return confirm('A jeni i sigurt?');"><i class="far fa-trash-alt"></i></a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php include 'inc/footer.php'; ?>
