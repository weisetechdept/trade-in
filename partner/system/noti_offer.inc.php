<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));

    $id = $request->id;
    $price = $request->price;
    $commission = $request->commission;
    $total = $request->total;
    $parent = $request->parent;

    $data = array(
        'off_price' => '',
        'off_vender' => '',
        'off_parent' => '',
        'off_datetime' => date('Y-m-d H:i:s')
    );

    $up = $db->insert('offer',$data);
    if($up){
        $api = array(
            'status' => '200',
            'message' => 'Success to offer'
        );
    } else {
        $api = array(
            'status' => '400',
            'message' => 'Offer not Success'
        );
    }

    echo json_encode($api);




