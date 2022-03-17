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
if($_SESSION['nis'] && $_SESSION['nama']){
    $status = false;
    try{
        $user = new User($_SESSION['nis'], $_SESSION['nama']);
        if(isset($_POST['index'])){
            $status = $user->Edit(intval($_POST['index']), $_POST['tanggal'], $_POST['jam'], $_POST['lokasi'], intval($_POST['suhu']));
        }else{
            $status = boolval($user->buat_catatan($_POST['tanggal'], $_POST['jam'], $_POST['lokasi'], intval($_POST['suhu'])));
        }
        echo json_encode(['status' => $status], JSON_PRETTY_PRINT);
    }catch(Exception $e){
        echo json_encode(['status' => false],JSON_PRETTY_PRINT);
    }
}else{
    echo json_encode(['status' => false],JSON_PRETTY_PRINT);
}
?>