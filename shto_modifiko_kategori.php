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
if(isset($_POST['shtokategori'])){
    shtoKategori($_POST['emri'],$_POST['pershkrimi'],$_POST['kostoja']);
}
if(isset($_POST['modifikokategori'])){
   modifikoKategori($kategoriaid,$_POST['emri'],$_POST['pershkrimi'],$_POST['kostoja']);
}
?>

<section class="section-shto-modifiko container">
    <div class="forma">
        <br>
        <br>
        <h1>Forma per shtimin/modifikimin e Kategorisë</h1>
        <br>
        <form action="#" method="POST" id="kategoria">
            <div class="inputAndLabels">
                <label for="emri">Emri</label> <br>
                <input type="text" id="emri" name="emri"
                value="<?php if(!empty($emri)) echo $emri ?>">
            </div>
            <div class="inputAndLabels">
                <label for="pershkrimi">Pershkrimi</label> <br>
                <textarea id="pershkrimi" name="pershkrimi" rows="6">
                    <?php if(!empty($pershkrimi)) echo $pershkrimi ?>
                </textarea>
            </div>
            <div class="inputAndLabels">
                <label for="kostoja">Kostoja</label> <br>
                <input type="number" id="kostoja" name="kostoja"
                value="<?php if(!empty($kostoja)) echo $kostoja ?>">
            </div>
            <div class="inputAndLabels">
                <div class="butonat">
                    <?php
                    if (!isset($_GET['kid'])) {
                        echo "<input id='shtokategori' type='submit'
                            name='shtokategori' class='shtoModifiko' value='Shto Kategori'>";
                    } else {
                        echo "<input id='modifikokategori' type='submit'
                            name='modifikokategori' class='shtoModifiko' value='Modifiko Kategori'>";
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
