<?php
include "inc/functions.php";
requireAdmin();
include "inc/header.php";
include "inc/slide.php";


if (isset($_GET['brendetid'])) {
    $brendid = $_GET['brendetid'];
    $brendi = merrBrendId($brendid);
    $emri = $brendi['emri'];
    $vitthemelimi = $brendi['vitthemelimi'];
    $vendndodhja = $brendi['vendndodhja'];
    $website = $brendi['website'];
}

if (isset($_POST['fshibrend'])) {
    fshiBrend($brendid);
}
?>

<section class="section-shto-modifiko container">
    <div class="forma">
        <br>
        <br>
        <h1>Forma per fshirjen e Brendit</h1>
        <br>
        <form action="#" method="POST">
            <div class="inputAndLabels">
                <label for="emri">Emri</label> <br>
                <input type="text" id="emri" name="emri" disabled
                       value="<?php if (!empty($emri)) echo $emri ?>">
            </div>
            <div class="inputAndLabels">
                <label for="vitthemelimi">Viti Themelimit</label> <br>
                <input type="number" id="vitthemelimi" name="vitthemelimi" disabled
                       value="<?php if (!empty($vitthemelimi)) echo $vitthemelimi ?>">
            </div>
            <div class="inputAndLabels">
                <label for="vendndodhja">Vendndodhja</label> <br>
                <input type="text" id="vendndodhja" name="vendndodhja"disabled
                       value="<?php if (!empty($vendndodhja)) echo $vendndodhja ?>">
            </div>
            <div class="inputAndLabels">
                <label for="website">Website</label> <br>
                <input type="text" id="website" name="website" disabled
                       value="<?php if (!empty($website)) echo $website ?>">
            </div>
            <div class="inputAndLabels">
                <div class="butonat">
                    <input type="submit" name="fshibrend" value="Fshij brend">
                </div>
            </div>
        </form>
    </div>
</section>

<?php
include 'inc/footer.php';
?>
