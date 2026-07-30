<?php
session_start();
$dbconn;
dbConnection();

function dbConnection(){
    global $dbconn;
    $dbconn = mysqli_connect("localhost", "root", "", "watches");
    if(!$dbconn){
        die("Deshtoi lidhja me DB");
    }
    mysqli_set_charset($dbconn, "utf8mb4");
}

function e($value){
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}

function money($value){
    return number_format((float)$value, 2);
}

function isAdmin(){
    return isset($_SESSION['perdoruesi']['role']) && $_SESSION['perdoruesi']['role'] === 'Administrator';
}

function requireLogin(){
    if(!isset($_SESSION['perdoruesi'])){
        redirectWithMessage('login.php', 'Ju lutemi identifikohuni per te vazhduar.');
    }
}

function requireAdmin(){
    requireLogin();
    if(!isAdmin()){
        redirectWithMessage('index.php', 'Nuk keni qasje ne panelin e administrimit.');
    }
}

function cartCount(){
    if(empty($_SESSION['shporta'])){
        return 0;
    }
    $count = 0;
    foreach($_SESSION['shporta'] as $produkt){
        $count += (int)($produkt['sasia'] ?? 1);
    }
    return $count;
}

function watchImage($index){
    $images = [
        'img/o0.jpg', 'img/o10.jpg', 'img/o11.jpg', 'img/o12.jpg',
        'img/o13.jpg', 'img/o14.jpg', 'img/o15.jpg', 'img/o16.jpg',
        'img/o17.jpg', 'img/o18.jpg', 'img/o19.jpg', 'img/o20.jpg',
        'img/o21.jpg', 'img/o22.jpg', 'img/o23.jpg', 'img/o24.jpg',
        'img/o25.jpg', 'img/o26.jpg', 'img/o27.jpg', 'img/o28.jpg',
        'img/o29.jpg', 'img/o30.jpg', 'img/o31.jpg', 'img/o32.jpg',
        'img/a3.jpg', 'img/a4.jpg', 'img/a5.jpg', 'img/a6.jpg',
        'img/ora1.jpg', 'img/ora2.jpg', 'img/ora3.jpg', 'img/ora4.jpg'
    ];
    return $images[$index % count($images)];
}

function redirectWithMessage($url, $message){
    $_SESSION['message'] = $message;
    header("Location: $url");
    exit;
}

function login($email,$fjalekalimi){
    global $dbconn;
    $sql = "SELECT * FROM perdoruesit WHERE email=? AND fjalekalimi=? LIMIT 1";
    $stmt = mysqli_prepare($dbconn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $fjalekalimi);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) === 1){
        $perdoruesiData = mysqli_fetch_assoc($result);
        $_SESSION['perdoruesi'] = [
            'perdoruesiix' => $perdoruesiData['perdoruesiid'],
            'emrimbiemri' => $perdoruesiData['emri'] . " " . $perdoruesiData['mbiemri'],
            'role' => $perdoruesiData['role']
        ];
        header("Location: index.php");
        exit;
    }

    $_SESSION['message'] = "Email ose fjalekalim i pasakte.";
}

if(isset($_GET['argument'])){
    if($_GET['argument'] === "logout"){
        session_destroy();
        echo "index.php";
        exit;
    }else if($_GET['argument'] === "message" || $_GET['argument'] === "mesazhi"){
        unset($_SESSION['message']);
        exit;
    }
}
function merrPerdoruesit(){
    global $dbconn;
    $sql="SELECT perdoruesiid, emri, mbiemri, email, telefoni FROM perdoruesit";
    return mysqli_query($dbconn,$sql);
}
function merrPerdoruesId($pid){
    global $dbconn;
    $sql="SELECT perdoruesiid, emri, mbiemri, email, telefoni,fjalekalimi,nrpersonal FROM perdoruesit";
    $sql.=" WHERE perdoruesiid=$pid";
    $res=mysqli_query($dbconn,$sql);
    return mysqli_fetch_assoc($res);
}
function regjistroPerdorues($emri, $mbiemri, $email, $telefoni, $nrpersonal, $roli, $fjalekalimi) {
    global $dbconn;
    $checkEmailQuery = "SELECT * FROM perdoruesit WHERE email = '$email'";
    $checkEmailResult = mysqli_query($dbconn, $checkEmailQuery);
    if (mysqli_num_rows($checkEmailResult) > 0) {
        die("Ky email është tashmë i regjistruar.");
    }
    $sql="INSERT INTO perdoruesit(emri, mbiemri, email, fjalekalimi, telefoni, nrpersonal, role) VALUES ";
    $sql.="('$emri', '$mbiemri', '$email', '$fjalekalimi', '$telefoni', '$nrpersonal', '$roli')";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        $_SESSION['message']="Perdoruesi u regjistrua me sukses";
        header("Location: login.php");
    }else{
        die("Deshtoi shtimi i perdoruesit" . mysqli_error($dbconn));
    }
}

function shtoPerdorues($emri,$mbiemri,$roli,$nrpersonal,$telefoni,$email,$fjalekalimi){
    global $dbconn;
    $checkEmailQuery = "SELECT * FROM perdoruesit WHERE email = '$email'";
    $checkEmailResult = mysqli_query($dbconn, $checkEmailQuery);
    if (mysqli_num_rows($checkEmailResult) > 0) {
        die("Ky email është tashmë i regjistruar.");
    }
    $sql="INSERT INTO perdoruesit(emri, mbiemri, email, fjalekalimi, telefoni, nrpersonal, role) VALUES ";
    $sql.="('$emri', '$mbiemri', '$email', '$fjalekalimi', '$telefoni', '$nrpersonal', '$roli')";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        $_SESSION['message']="Perdoruesi u shtua me sukses";
        header("Location: perdoruesit.php");
    }else{
        die("Deshtoi shtimi i perdoruesit" . mysqli_error($dbconn));
    }
}
function modifikoPerdorues($perdoruesiid,$emri,$mbiemri,$roli,$nrpersonal,$telefoni,$email,$fjalekalimi){
    global $dbconn;
    $sql="UPDATE perdoruesit SET emri='$emri', mbiemri='$mbiemri', email='$email' ,";
    $sql.="fjalekalimi='$fjalekalimi', telefoni='$telefoni', nrpersonal='$nrpersonal'";
    $sql.=", role='$roli' WHERE perdoruesiid=$perdoruesiid ";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        $_SESSION['message']="Perdoruesi u modifukua me sukses";
        header("Location: perdoruesit.php");
    }else{
        die("Deshtoi modifikimi i perdoruesit" . mysqli_error($dbconn));
    }
}
function fshijPerdorues($perdoruesiid){
    global $dbconn;
    $sql="DELETE FROM perdoruesit WHERE perdoruesiid=$perdoruesiid";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        $_SESSION['message']="Perdoruesi u fshi me sukses";
        header("Location:perdoruesit.php");
    }else{
        die("Deshtoi" . mysqli_eror($dbconn));
    }
}

function merrKategorit(){
    global $dbconn;
    $sql="SELECT * FROM `kategorite`";
    return mysqli_query($dbconn,$sql); 
}
function merrKategoriId($kid){
    global $dbconn;
    $sql="SELECT * FROM `kategorite` WHERE kategoriaid=$kid";
    $res=mysqli_query($dbconn,$sql);
    return mysqli_fetch_assoc($res); 
}
function shtoKategori($emri,$pershkrimi,$kostoja){
    global $dbconn;
    $sql="INSERT INTO `kategorite`(emri, pershkrimi, kostoja) VALUES ('$emri', '$pershkrimi', $kostoja)";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        $_SESSION['message']="Kategoria u shtua me sukses";
        header("Location: kategorite.php");
    }else{
        die("Deshtoi shtimi i kategoris" . mysqli_error($dbconn));
    }
}
function modifikoKategori($kategoriaid,$emri,$pershkrimi,$kostoja){
    global $dbconn;
    $sql="UPDATE `kategorite`  SET emri='$emri', pershkrimi='$pershkrimi', kostoja='$kostoja'";
    $sql.=" WHERE kategoriaid=$kategoriaid ";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        $_SESSION['message']="Kategoria u modifiku me sukses";
        header("Location: kategorite.php");
    }else{
        die("Deshtoi modifikimi i kategoris" . mysqli_error($dbconn));
    }
}
function fshiKategori($kategoriaid){
    global $dbconn;
    $sql="DELETE FROM `kategorite` WHERE kategoriaid=$kategoriaid";
    $result=mysqli_query($dbconn,$sql);
    if($result){
        $_SESSION['message']="Kategoria u fshie me sukses";
        header("Location: kategorite.php");
    }else{
        die("Deshtoi fshirja i kategoris" . mysqli_error($dbconn));
    }}
function merrOfertat(){
    global $dbconn;
    $sql="SELECT * FROM ofertat";
    return mysqli_query($dbconn,$sql);
}
function merrOfertaId($oid){
    global $dbconn;
    $sql="SELECT * FROM `ofertat` WHERE OfertaID=$oid";
    $res=mysqli_query($dbconn, $sql);
    return mysqli_fetch_assoc($res); 
}

function shtoOferte($emriOfertes, $zbritja, $dataFillimit, $dataSkadimit){
    global $dbconn;
    $sql="INSERT INTO `ofertat` (EmriOfertes, Zbritja, DataFillimit, DataSkadimit) VALUES ('$emriOfertes', $zbritja, '$dataFillimit', '$dataSkadimit')";
    $res=mysqli_query($dbconn, $sql);
    if($res){
        $_SESSION['message']="Oferta u shtua me sukses";
        header("Location: ofertat.php");
    }else{
        die("Deshtoi shtimi i ofertes" . mysqli_error($dbconn));
    }
}

function modifikoOferte($ofertaid, $emriOfertes, $zbritja, $dataFillimit, $dataSkadimit){
    global $dbconn;
    $sql="UPDATE `ofertat` SET EmriOfertes='$emriOfertes', Zbritja=$zbritja, DataFillimit='$dataFillimit', DataSkadimit='$dataSkadimit' WHERE OfertaID=$ofertaid";
    $res=mysqli_query($dbconn, $sql);
    if($res){
        $_SESSION['message']="Oferta u modifiku me sukses";
        header("Location: ofertat.php");
    }else{
        die("Deshtoi modifikimi i ofertes" . mysqli_error($dbconn));
    }
}

function fshiOferte($ofertaid){
    global $dbconn;
    $sql="DELETE FROM `ofertat` WHERE OfertaID=$ofertaid";
    $result=mysqli_query($dbconn, $sql);
    if($result){
        $_SESSION['message']="Oferta u fshie me sukses";
        header("Location: ofertat.php");
    }else{
        die("Deshtoi fshirja i ofertes" . mysqli_error($dbconn));
    }
}
function merrBrendet(){
    global $dbconn;
    $sql = "SELECT * FROM brendet";
    return mysqli_query($dbconn, $sql);
}

function merrBrendId($brendid){
    global $dbconn;
    $sql = "SELECT * FROM brendet WHERE brendetid = $brendid";
    $res = mysqli_query($dbconn, $sql);
    return mysqli_fetch_assoc($res);
}

function shtoBrend($emri, $vitthemelimi, $vendndodhja, $website){
    global $dbconn;
    $sql = "INSERT INTO brendet (emri, vitthemelimi, vendndodhja, website) VALUES ('$emri', $vitthemelimi, '$vendndodhja', '$website')";
    $res = mysqli_query($dbconn, $sql);
    if($res){
        $_SESSION['message'] = "Brendi u shtua me sukses";
        header("Location: brendet.php");
    } else {
        die("Deshtoi shtimi i brendit" . mysqli_error($dbconn));
    }
}

function modifikoBrend($brendid, $emri, $vitthemelimi, $vendndodhja, $website){
    global $dbconn;
    $sql = "UPDATE brendet SET emri = '$emri', vitthemelimi = $vitthemelimi, vendndodhja = '$vendndodhja', website = '$website' WHERE brendetid = $brendid";
    $res = mysqli_query($dbconn, $sql);
    if($res){
        $_SESSION['message'] = "Brendi u modifikua me sukses";
        header("Location: brendet.php");
    } else {
        die("Deshtoi modifikimi i brendit" . mysqli_error($dbconn));
    }
}

function fshiBrend($brendid){
    global $dbconn;
    $sql = "DELETE FROM brendet WHERE brendetid = $brendid";
    $result = mysqli_query($dbconn, $sql);
    if($result){
        $_SESSION['message'] = "Brendi u fshi me sukses";
        header("Location: brendet.php");
    } else {
        die("Deshtoi fshirja e brendit" . mysqli_error($dbconn));
    }
}
function modifikoProfil($perdoruesiid, $emri, $mbiemri, $roli, $nrpersonal, $telefoni, $email, $fjalekalimi)
{
    global $dbconn;
    // Përmirësim: Përdorimi i parameterizuar për siguri
    $sql = "UPDATE perdoruesit SET emri=?, mbiemri=?, email=?, fjalekalimi=?, telefoni=?, nrpersonal=?, role=? WHERE perdoruesiid=?";
    
    $stmt = mysqli_prepare($dbconn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssi", $emri, $mbiemri, $email, $fjalekalimi, $telefoni, $nrpersonal, $roli, $perdoruesiid);
    
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Profile modified successfully!";
        header("Location: index.php");
        exit(); 
    } else {
        echo "Error modifying profile: " . mysqli_error($dbconn);
    }
    
}
function merrOret(){
    global $dbconn;
    $sql = "SELECT * FROM orat";
    return mysqli_query($dbconn,$sql);
}

function merrEmratOreve(){
    global $dbconn;
    $sql = "SELECT DISTINCT emri FROM orat ORDER BY emri ASC";
    return mysqli_query($dbconn, $sql);
}

function merrStatistikaKatalogu(){
    global $dbconn;
    $stats = [
        'produkte' => 0,
        'brende' => 0,
        'min_cmimi' => 0,
        'max_cmimi' => 0
    ];

    $result = mysqli_query($dbconn, "SELECT COUNT(*) AS produkte, COUNT(DISTINCT emri) AS brende, MIN(cmimi) AS min_cmimi, MAX(cmimi) AS max_cmimi FROM orat");
    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $stats['produkte'] = (int)$row['produkte'];
        $stats['brende'] = (int)$row['brende'];
        $stats['min_cmimi'] = (float)$row['min_cmimi'];
        $stats['max_cmimi'] = (float)$row['max_cmimi'];
    }

    return $stats;
}

function merrOretKatalog($filters = []){
    global $dbconn;

    $search = trim($filters['search'] ?? '');
    $brand = trim($filters['brand'] ?? '');
    $min = $filters['min'] ?? '';
    $max = $filters['max'] ?? '';
    $sort = $filters['sort'] ?? 'newest';
    $page = max(1, (int)($filters['page'] ?? 1));
    $perPage = max(1, min(24, (int)($filters['per_page'] ?? 8)));
    $offset = ($page - 1) * $perPage;

    $where = [];
    $params = [];
    $types = '';

    if($search !== ''){
        $where[] = "(emri LIKE ? OR modeli LIKE ?)";
        $like = "%$search%";
        $params[] = $like;
        $params[] = $like;
        $types .= 'ss';
    }

    if($brand !== ''){
        $where[] = "emri = ?";
        $params[] = $brand;
        $types .= 's';
    }

    if($min !== '' && is_numeric($min)){
        $where[] = "cmimi >= ?";
        $params[] = (float)$min;
        $types .= 'd';
    }

    if($max !== '' && is_numeric($max)){
        $where[] = "cmimi <= ?";
        $params[] = (float)$max;
        $types .= 'd';
    }

    $whereSql = $where ? " WHERE " . implode(" AND ", $where) : "";
    $orderSql = " ORDER BY id DESC";
    if($sort === 'price_asc'){
        $orderSql = " ORDER BY cmimi ASC";
    }elseif($sort === 'price_desc'){
        $orderSql = " ORDER BY cmimi DESC";
    }elseif($sort === 'name_asc'){
        $orderSql = " ORDER BY emri ASC, modeli ASC";
    }

    $countSql = "SELECT COUNT(*) AS total FROM orat" . $whereSql;
    $countStmt = mysqli_prepare($dbconn, $countSql);
    if($types !== ''){
        mysqli_stmt_bind_param($countStmt, $types, ...$params);
    }
    mysqli_stmt_execute($countStmt);
    $countResult = mysqli_stmt_get_result($countStmt);
    $total = (int)mysqli_fetch_assoc($countResult)['total'];

    $sql = "SELECT * FROM orat" . $whereSql . $orderSql . " LIMIT ? OFFSET ?";
    $stmt = mysqli_prepare($dbconn, $sql);
    $queryParams = $params;
    $queryParams[] = $perPage;
    $queryParams[] = $offset;
    $queryTypes = $types . 'ii';
    mysqli_stmt_bind_param($stmt, $queryTypes, ...$queryParams);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return [
        'result' => $result,
        'total' => $total,
        'page' => $page,
        'per_page' => $perPage,
        'pages' => max(1, (int)ceil($total / $perPage))
    ];
}

?>
