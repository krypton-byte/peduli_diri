<?php
session_start();
header('content-type: application/json');
if($_SESSION['nis']){
    require 'Engine/csv.php';
    try{
        $user = new User($_SESSION['nis'], $_SESSION['nama']);
        $user->Masuk();
        $status = $user->Hapus(intval($_POST['index']));
        echo json_encode(['status' => $status]);
        exit();
    }catch(Exception $e){
        echo $e;
        echo json_encode(['status' => false]);
        exit();
    }
}
echo json_encode(['status' => false]);
?>