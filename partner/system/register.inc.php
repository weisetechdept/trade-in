<?php 
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));

    $uid = $request->uid;
    $img_profile = $request->img_profile;
    $bus_name = $request->bus_name;
    $pt_fname = $request->pt_fname;
    $pt_lname = $request->pt_lname;
    $pt_tel = $request->tel;

    if($uid == '' || $img_profile == '' || $bus_name == '' || $pt_fname == '' || $pt_lname == '' || $pt_tel == ''){

        $api = array('status' => '400', 'msg' => 'Data not complete');
        exit();

    } else {

        $data = array(
            'part_fname' => $pt_fname,
            'part_lname' => $pt_lname,
            'part_tel' => $pt_tel,
            'part_bus_name' => $bus_name,
            'part_bus_id' => '0',
            'part_line_uid' => $uid,
            'part_line_img' => $img_profile,
            'part_permission' => 'user',
            'part_group' => '2',
            'part_status' => '0',
            'part_datetime' => date('Y-m-d H:i:s')
        );
    
        $inc = $db->insert('partner', $data);
        if($inc){
            $api = array('status' => '200');
        }else{
            $api = array('status' => '400', 'message' => 'คุณเคยลงทะเบียนแล้ว โปรดรอการอนุมัติจากเจ้าหน้าที่');
        }

    }

    echo json_encode($api);

