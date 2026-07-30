<?php
include "inc/functions.php";
requireAdmin();
include "inc/header.php";
include "inc/slide.php";


if (isset($_GET['brendetid'])) {
    $brendid = $_GET['brendetid'];
    $brendi = merrBrendId($brendid);
    $emriBrendit = $brendi['emri'];
    $vitThemelimi = $brendi['vitthemelimi'];
    $vendndodhja = $brendi['vendndodhja'];
    $website = $brendi['website'];
}

if (isset($_POST['shtobrend'])) {
    shtoBrend($_POST['emribrendit'], $_POST['vitthemelimi'], $_POST['vendndodhja'], $_POST['website']);
}

if (isset($_POST['modifikobrend'])) {
    modifikoBrend($brendid, $_POST['emribrendit'], $_POST['vitthemelimi'], $_POST['vendndodhja'], $_POST['website']);
}
?>

<section class="section-shto-modifiko container">
    <div class="forma">
        <br>
        <br>
        <h1>Forma për shtimin/modifikimin e Brendit</h1>
        <br>
        <form action="#" method="POST" id="brendet">
            <div class="inputAndLabels">
                <label for="emribrendit">Emri i Brendit</label> <br>
                <input type="text" id="emribrendit" name="emribrendit"
                       value="<?php if (!empty($emriBrendit)) echo $emriBrendit ?>">
            </div>
            <div class="inputAndLabels">
                <label for="vitthemelimi">Viti Themelimit</label> <br>
                <input type="number" id="vitthemelimi" name="vitthemelimi"
                       value="<?php if (!empty($vitThemelimi)) echo $vitThemelimi ?>">
            </div>
            <div class="inputAndLabels">
                <label for="vendndodhja">Vendndodhja</label> <br>
                <input type="text" id="vendndodhja" name="vendndodhja"
                       value="<?php if (!empty($vendndodhja)) echo $vendndodhja ?>">
            </div>
            <div class="inputAndLabels">
                <label for="website">Website</label> <br>
                <input type="text" id="website" name="website"
                       value="<?php if (!empty($website)) echo $website ?>">
            </div>
            <div class="inputAndLabels">
                <div class="butonat">
                    <?php
                    if (!isset($_GET['brendetid'])) {
                        echo "<input id='shtobrend' type='submit'
                            name='shtobrend' class='shtoModifiko' value='Shto Brend'>";
                    } else {
                        echo "<input id='modifikobrend' type='submit'
                            name='modifikobrend' class='shtoModifiko' value='Modifiko Brend'>";
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
include 'inc/footer.php';
include 'inc/validimi.php';
?>
