<?php
include "inc/functions.php";
requireAdmin();
include "inc/header.php";
include "inc/slide.php";


if (isset($_GET['pid'])) {
    $perdoruesiid = $_GET['pid'];
    $perdoruesi = merrPerdoruesId($perdoruesiid);
    $emri = $perdoruesi['emri'];
    $mbiemri = $perdoruesi['mbiemri'];
    $nrpersonal = $perdoruesi['nrpersonal'];
    $telefoni = $perdoruesi['telefoni'];
    $email = $perdoruesi['email'];
    $fjalekalimi = $perdoruesi['fjalekalimi'];
}
if (isset($_POST['fshiperdorues'])) {
    fshijPerdorues($perdoruesiid);
}
?>

<section class="section-shto-modifiko container">
    <div class="forma">
        <br>
        <br>
        <h1>Forma per fshirjen e Perdoruesit</h1>
        <br>
        <form method="post">

            <div class="inputAndLabels">
                <label for="emri">Emri</label> <br>
                <input type="text" id="emri" name="emri" disabled value="<?php if (!empty($emri)) echo $emri ?>">
            </div>
            <div class="inputAndLabels">
                <label for="mbiemri">Mbiemri</label> <br>
                <input type="text" id="mbiemri" name="mbiemri" disabled value="<?php if (!empty($mbiemri)) echo $mbiemri ?>">
            </div>
            <div class="inputAndLabels">
                <label for="roli">Roli</label> <br>
                <select id="roli" name="roli" disabled>
                    <option value="0">Perdorues</option>
                    <option value="1">Administrator</option>
                </select>
            </div>
            <div class="inputAndLabels">
                <label for="nrpersonal">Nr personal</label> <br>
                <input type="text" id="nrpersonal" name="nrpersonal" disabled value="<?php if (!empty($nrpersonal)) echo $nrpersonal ?>">
            </div>
            <div class="inputAndLabels">
                <label for="telefoni">Nr telefonit</label> <br>
                <input type="text" id="telefoni" name="telefoni" disabled value="<?php if (!empty($telefoni)) echo $telefoni ?>">
            </div>
            <div class="inputAndLabels">
                <label for="email">Email</label> <br>
                <input type="email" id="email" name="email" disabled value="<?php if (!empty($email)) echo $email ?>">
            </div>
            <div class="inputAndLabels">
                <label for="fjalekalimi">Fjalekalimi</label> <br>
                <input type="password" id="fjalekalimi" name="fjalekalimi" disabled value="<?php if (!empty($fjalekalimi)) echo $fjalekalimi ?>">
            </div>
            <div class="inputAndLabels">
                <div class="butonat">
                <input id='fshiperdorues' type='submit'
                 name='fshiperdorues' class='shtoModifiko' value='Fshi Perdorues'>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
include 'inc/footer.php'
?>
