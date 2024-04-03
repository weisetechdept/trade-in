<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));
    
    $id = $request->id;
    $switchPublic = $request->switchPublic;

    if($switchPublic == 'true'){
        $switchPublic = 0;
    }else{
        $switchPublic = 1;
    }

    $data = array(
        'link_public' => $switchPublic
    );

    $id = $db->where('cast_id', $id)->update('car_stock', $data);

    if ($id){
        $api = array('status' => '200','id' => $id);
    } else {
        $api = array('status' => '400');
    }

    echo json_encode($api);


