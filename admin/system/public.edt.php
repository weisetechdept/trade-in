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
        $switchPublic = $request->switchPublic;

        if($switchPublic == true){
            $switchPublic = 0;
        }else{
            $switchPublic = 1;
        }

        $data = array(
            'cast_link_public' => $switchPublic
        );

        $id = $db->where('cast_id', $id)->update('car_stock', $data);

        if ($id){
            $api = array('status' => '200','id' => $id);
        } else {
            $api = array('status' => '400');
        }

        echo json_encode($api);

    }

    


