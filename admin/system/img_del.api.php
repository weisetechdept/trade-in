<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    } else {

        $request = json_decode(file_get_contents('php://input'));
        $id = $request->id;

        if(!empty($id)){
            $data = Array (
                'cari_status' => '0'
            );
            $db->where ('cari_id', $id);
            if ($db->update ('car_image', $data)){
                echo json_encode(array('status' => 200));
            } else {
                echo json_encode(array('status' => 505));
            }
        }

    }

    
