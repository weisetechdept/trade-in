<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }

    $data = json_decode(file_get_contents("php://input"));

    if(isset($data->aimg_img_id)){
        $img_id = $data->aimg_img_id;
        $img_link = $data->aimg_link;
        $img_link_500 = $data->aimg_link_500;
        $img_parent = $data->aimg_parent;
        $img_group = $data->aimg_group;
    
        $data = Array (
            "cari_img_id" => $img_id,
            "cari_link" => $img_link,
            "cari_link_500" => $img_link_500,
            "cari_group" => $img_group,
            "cari_parent" => $img_parent,
            "cari_status" => "1",
            "cari_datetime" => date("Y-m-d H:i:s")
        );
        
        $id = $db->insert ('car_image', $data);
        if ($id){

            echo json_encode(array('status' => '200'));
            
        } else {
            echo json_encode(array('status' => '400'));
        }
    }