<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));

    $id = $request->id;
    $price = $request->price;
    $commission = $request->commission;
    $total = $request->total;

    $data = array(
        'off_price' => $price,
        'off_vender' => 'part_id',
        'off_parent' => $id,
        'off_datetime' => date('Y-m-d H:i:s')
    );


