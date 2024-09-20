<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }

    $request = json_decode(file_get_contents('php://input'));

    $id = $request->id;
    $group = $request->group;

    if(!empty($id)){
        $data = Array (
            'cari_group' => $group
        );
        $db->where ('cari_id', $id);
        if ($db->update ('car_image', $data)){
            $api = array('status' => 200);
        } else {
            $api = array('status' => 505, 'msg' => 'ไม่สามารถบันทึกข้อมูลได้ โปรดลองใหม่อีกครั้ง');
        }
    } else {
        $api = array('status' => 505, 'msg' => 'ไม่สามารถบันทึกข้อมูลได้ ไม่เจอข้อมูล หรือข้อมูลไม่ถูกค้อง โปรดลองใหม่อีกครั้ง');
    }
   
    print_r(json_encode($api));