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
            <h1>Perdoruesit</h1>
            <p>Menaxho klientet, rolet dhe kontaktet e regjistruara.</p>
        </div>
        <a href="shto_modifiko_perdorues.php" id="add_entity"><i class="fas fa-plus"></i> Shto perdorues</a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Emri</th>
                <th>Mbiemri</th>
                <th>Email</th>
                <th>Telefoni</th>
                <th>Modifiko</th>
                <th>Fshij</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $perdoruesit = merrPerdoruesit();
            while($perdoruesi = mysqli_fetch_assoc($perdoruesit)):
                $pid = $perdoruesi['perdoruesiid'];
            ?>
                <tr>
                    <td><?= e($perdoruesi['emri']); ?></td>
                    <td><?= e($perdoruesi['mbiemri']); ?></td>
                    <td><?= e($perdoruesi['email']); ?></td>
                    <td><?= e($perdoruesi['telefoni']); ?></td>
                    <td><a href="shto_modifiko_perdorues.php?pid=<?= (int)$pid; ?>"><i class="fas fa-edit"></i></a></td>
                    <td><a href="fshijperdorues.php?pid=<?= (int)$pid; ?>" onclick="return confirm('A jeni i sigurt?');"><i class="far fa-trash-alt"></i></a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php include "inc/footer.php"; ?>
