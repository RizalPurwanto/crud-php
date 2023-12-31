<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/peserta.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Peserta($db);
    
    $data = json_decode(file_get_contents("php://input"));
   
    $item->id = $data->id;
   
    if($item->deletePeserta()){
        echo json_encode("Peserta berhasil dihapus.");
    } else{
        echo json_encode("Peserta gagal dihapus");
    }
?>