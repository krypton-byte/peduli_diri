<?php
session_start();
require '../Engine/csv.php';
header('content-type: application/json');
if(!(
    isset($_POST['tanggal']) && 
    isset($_POST['jam']) && 
    isset($_POST['lokasi']) && 
    isset($_POST['suhu']) && 
    is_numeric($_POST['suhu'])
    )){
        echo json_encode(['status' => false],JSON_PRETTY_PRINT);
        exit();
}
if(@$_SESSION['nik'] && @$_SESSION['nama']){
    $user = new User($_SESSION['nik'], $_SESSION['nama']);
    $user->buat_catatan($_POST['tanggal'], $_POST['jam'], $_POST['lokasi'], intval($_POST['suhu']));
    echo json_encode(['status' => true], JSON_PRETTY_PRINT);
}else{
    echo json_encode(['status' => false],JSON_PRETTY_PRINT);
}
?>
