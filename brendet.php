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
            <h1>Brendet</h1>
            <p>Mbaj te rregullta brendet, vitin e themelimit dhe webfaqet zyrtare.</p>
        </div>
        <a href="shto_modifiko_brend.php" id="add_entity"><i class="fas fa-plus"></i> Shto brend</a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Emri</th>
                <th>Viti themelimit</th>
                <th>Vendndodhja</th>
                <th>Website</th>
                <th>Modifiko</th>
                <th>Fshij</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $brendet = merrBrendet();
            while ($brendi = mysqli_fetch_assoc($brendet)):
                $brendid = $brendi['brendetid'];
            ?>
                <tr>
                    <td><?= e($brendi['emri']); ?></td>
                    <td><?= e($brendi['vitthemelimi']); ?></td>
                    <td><?= e($brendi['vendndodhja']); ?></td>
                    <td><a href="<?= e($brendi['website']); ?>" target="_blank" rel="noreferrer"><?= e($brendi['website']); ?></a></td>
                    <td><a href="shto_modifiko_brend.php?brendetid=<?= (int)$brendid; ?>"><i class="fas fa-edit"></i></a></td>
                    <td><a href="fshijbrend.php?brendetid=<?= (int)$brendid; ?>" onclick="return confirm('A jeni i sigurt?');"><i class="far fa-trash-alt"></i></a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php include 'inc/footer.php'; ?>
