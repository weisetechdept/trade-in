<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));

    $detail = $request->detail;
    $date = $request->date;
    $parent = $request->parent;

    if(empty($detail) || empty($date) || empty($parent)){
        $api = array('status' => 'error', 'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน');
        echo json_encode($api);
        exit();
    } else {

        $data = array(
            'even_detail' => $detail,
            'even_date' => $date,
            'even_parent' => $parent,
            'even_datetime' => date('Y-m-d H:i:s')
        );
    
        $insMeet = $db->insert('event', $data);
        if($insMeet){
            $api = array('status' => 'success', 'message' => 'เพิ่มข้อมูลสำเร็จ');
        } else {
            $api = array('status' => 'error', 'message' => 'เพิ่มข้อมูลไม่สำเร็จ');
        }

    }

    echo json_encode($api);
