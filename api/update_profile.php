<?php
session_start();
require '../Engine/csv.php';
header('content-type: application/json');
try{
    $user = new User($_SESSION['nis'], $_SESSION['nama']);
    $user->Masuk();
    $response = ['status' => false];
    if($user->setProfile($_FILES['img']['tmp_name'])){
        $response['status'] = true;
        $response['path'] = $user->getProfile();
    }
    echo json_encode($response);
}catch(Exception $e){
echo json_encode(['status' => false]);
}

?>