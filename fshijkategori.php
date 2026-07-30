<?php
include "inc/functions.php";
requireAdmin();
include "inc/header.php";
include "inc/slide.php";

if (isset($_GET['kid'])) {
    $kategoriaid=$_GET['kid'];
    $kategoria=merrKategoriId($kategoriaid);
    $emri=$kategoria['emri'];
    $pershkrimi=$kategoria['pershkrimi'];
    $kostoja=$kategoria['kostoja'];
}
if(isset($_POST['fshikategori'])){
    fshiKategori($kategoriaid);
}
?>

<section class="section-shto-modifiko container">
    <div class="forma">
        <br>
        <br>
        <h1>Forma per fshirjen e Kategorisë</h1>
        <br>
        <form action="#" method="POST">
            <div class="inputAndLabels">
                <label for="emri">Emri</label> <br>
                <input type="text" id="emri" name="emri" disabled
                value="<?php if(!empty($emri)) echo $emri ?>">
            </div>
            <div class="inputAndLabels">
                <label for="pershkrimi">Pershkrimi</label> <br>
                <textarea id="pershkrimi" name="pershkrimi" rows="6" disabled>
                    <?php if(!empty($pershkrimi)) echo $pershkrimi ?>
                </textarea>
            </div>
            <div class="inputAndLabels">
                <label for="kostoja">Kostoja</label> <br>
                <input type="number" id="kostoja" name="kostoja" disabled
                value="<?php if(!empty($kostoja)) echo $kostoja ?>">
            </div>
            <div class="inputAndLabels">
                <div class="butonat">
                <input id='fshikategori' type='submit'
                name='fshikategori' class='shtoModifiko' value='Fshi Kategori'>
                </div>
            </div>
        </form>
    </div>
</section>
<?php
include "inc/footer.php";

?>
