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

            $img = $db->where('cari_id',$id)->getOne('car_image',null,'cari_parent');
            $stock_id = $img['cari_parent'];

            $data = array(
                'cast_thumb' => $id
            );
            $update = $db->where('cast_id',$stock_id)->update('car_stock', $data);
            if ($update){
                echo json_encode(array('status' => '200'));
            } else {
                echo json_encode(array('status' => '505'));
            }

        }

        