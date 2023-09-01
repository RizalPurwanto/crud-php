<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/peserta.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Peserta($db);
    $stmt = $items->getPeserta();
    $itemCount = $stmt->rowCount();

    // echo json_encode($itemCount);
    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "nama" => $nama,
                "email" => $email,
                "no_hp" => $no_hp,
                "nik" => $nik,

                "kpj" => $kpj,
                "tempat_lahir" => $tempat_lahir,
                "tanggal_lahir" => $tanggal_lahir,
                "alamat" => $alamat,

                "created" => $created
            );
            array_push($employeeArr["body"], $e);
        }
        echo json_encode($employeeArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Data tidak ditemukan.")
        );
    }
?>