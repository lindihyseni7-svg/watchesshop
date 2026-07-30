<?php
include "inc/functions.php";
requireAdmin();
include "inc/header.php";
include "inc/slide.php";


if (isset($_GET['ofertaid'])) {
    $ofertaid = $_GET['ofertaid'];
    $oferta = merrOfertaId($ofertaid);
    $emriOfertes = $oferta['emriofertes'];
    $zbritja = $oferta['zbritja'];
    $dataFillimit = $oferta['datafillimit'];
    $dataSkadimit = $oferta['dataskadimit'];
}

if (isset($_POST['shtooferte'])) {
    shtoOferte($_POST['emriofertes'], $_POST['zbritja'], $_POST['datafillimit'], $_POST['dataskadimit']);
}

if (isset($_POST['modifikoooferte'])) {
    modifikoOferte($ofertaid, $_POST['emriofertes'], $_POST['zbritja'], $_POST['datafillimit'], $_POST['dataskadimit']);
}
?>

<section class="section-shto-modifiko container">
    <div id="ofertat">
    <div class="forma">
        <br>
        <br>
        <h1>Forma per shtimin/modifikimin e Ofertës</h1>
        <br>
        <form action="#" method="POST" id="oferta">
            <div class="inputAndLabels">
                <label for="emriofertes">Emri Ofertës</label> <br>
                <input type="text" id="emriofertes" name="emriofertes"
                       value="<?php if (!empty($emriOfertes)) echo $emriOfertes ?>">
            </div>
            <div class="inputAndLabels">
                <label for="zbritja">Zbritja</label> <br>
                <input type="number" id="zbritja" name="zbritja"
                       value="<?php if (!empty($zbritja)) echo $zbritja ?>">
            </div>
            <div class="inputAndLabels">
                <label for="datafillimit">Data Fillimit</label> <br>
                <input type="date" id="datafillimit" name="datafillimit"
                       value="<?php if (!empty($dataFillimit)) echo $dataFillimit ?>">
            </div>
            <div class="inputAndLabels">
                <label for="dataskadimit">Data Skadimit</label> <br>
                <input type="date" id="dataskadimit" name="dataskadimit"
                       value="<?php if (!empty($dataSkadimit)) echo $dataSkadimit ?>">
            </div>
            <div class="inputAndLabels">
                <div class="butonat">
                    <?php
                    if (!isset($_GET['ofertaid'])) {
                        echo "<input id='shtooferte' type='submit'
                            name='shtooferte' class='shtoModifiko' value='Shto Ofertë'>";
                    } else {
                        echo "<input id='modifikoooferte' type='submit'
                            name='modifikoooferte' class='shtoModifiko' value='Modifiko Ofertë'>";
                    }
                    ?>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#oferta").submit(function (event) {
            var dataFillimit = new Date($("#datafillimit").val());
            var dataSkadimit = new Date($("#dataskadimit").val());
            if (dataFillimit >= dataSkadimit) {
                alert("Data e fillimit duhet te jete ma e vogel se data e skadimit.");
                event.preventDefault();
            }
        });
    });
</script>

<?php
include 'inc/footer.php';
include 'inc/validimi.php';
?>
