<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/peserta.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Peserta($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->nama = $data->nama;
    $item->email = $data->email;
    $item->no_hp = $data->no_hp;
    $item->nik = $data->nik;

    $item->kpj = $data->kpj;
    $item->tempat_lahir = $data->tempat_lahir;
    $item->tanggal_lahir = $data->tanggal_lahir;
    $item->alamat = $data->alamat;
    
    $item->created = date('Y-m-d H:i:s');
    
    if($item->createPeserta()){
        echo 'Peserta baru berhasil ditambahkan.';
    } else{
        echo 'Peserta gagal ditambahkan.';
    }
?>