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

if (isset($_POST['fshijofert'])) {
    fshiOferte($ofertaid);
}
?>

<section class="section-shto-modifiko container">
    <div class="forma">
        <br>
        <br>
        <h1>Forma per fshirjen e Ofertës</h1>
        <br>
        <form action="#" method="POST">
            <div class="inputAndLabels">
                <label for="emriofertes">Emri Ofertës</label> <br>
                <input type="text" id="emriofertes" name="emriofertes" disabled
                       value="<?php if (!empty($emriOfertes)) echo $emriOfertes ?>">
            </div>
            <div class="inputAndLabels">
                <label for="zbritja">Zbritja</label> <br>
                <input type="number" id="zbritja" name="zbritja" disabled
                       value="<?php if (!empty($zbritja)) echo $zbritja ?>">
            </div>
            <div class="inputAndLabels">
                <label for="datafillimit">Data Fillimit</label> <br>
                <input type="date" id="datafillimit" name="datafillimit" disabled
                       value="<?php if (!empty($dataFillimit)) echo $dataFillimit ?>">
            </div>
            <div class="inputAndLabels">
                <label for="dataskadimit">Data Skadimit</label> <br>
                <input type="date" id="dataskadimit" name="dataskadimit" disabled
                       value="<?php if (!empty($dataSkadimit)) echo $dataSkadimit ?>">
            </div>
            <div class="inputAndLabels">
                <div class="butonat">
                    <input type="submit" name="fshijofert" value="Fshij oferte">
                </div>
            </div>
        </form>
    </div>
</section>

<?php
include 'inc/footer.php';
?>
