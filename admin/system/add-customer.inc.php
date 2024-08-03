<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));

    $car = $request->car;
    $name = $request->name;
    $detail = $request->detail;
    $tel = $request->tel;
    $line = $request->line;
    $status = $request->status;

    $data = array(
        'cust_parent' => $car,
        'cust_name' => $name,
        'cust_detail' => $detail,
        'cust_tel' => $tel,
        'cust_line' => $line,
        'cust_status' => $status,
        'cust_datetime' => date('Y-m-d H:i:s'),
    );

    $insert = $db->insert('customer_data',$data);
    if($insert){
        $api = array('status' => 'success', 'message' => 'เพิ่มข้อมูลลูกค้าสำเร็จ');
    }else{
        $api = array('status' => 'error','message' => 'เพิ่มข้อมูลลูกค้าไม่สำเร็จ');
    }

    echo json_encode($api);
