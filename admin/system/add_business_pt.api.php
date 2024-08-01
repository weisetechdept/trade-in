<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));

    $name = $request->name;

    $data = array(
        'busi_name' => $name,
        'busi_status' => 1,
        'busi_datetime' => date('Y-m-d H:i:s')
    );

    $inc = $db->insert('partner_bus', $data);

    if($inc){
        $api = array('status' => 'success', 'message' => 'บันทึกข้อมูลสำเร็จ');
    } else {
        $api = array('status' => 'error', 'message' => 'บันทึกข้อมูลไม่สำเร็จ');
    }

    echo json_encode($api);
