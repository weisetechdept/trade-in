<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));

    if(empty($request->nameSys) || empty($request->lineUid) || empty($request->lineImg)){
        $api = array('status' => 'error', 'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน');
  
    } else {

        $name = $request->nameSys;
        $uid = $request->lineUid;
        $profile = $request->lineImg;
    
        $data = array(
            'user_nickname' => $name,
            'user_line_uid' => $uid,
            'user_line_img' => $profile,
            'user_permission' => 'admin',
            'user_status' => '0',
            'user_datetime' => date('Y-m-d H:i:s')
        );
    
        $insUser = $db->insert('user', $data);
        if($insUser){
            $api = array('status' => 'success');
        } else {
            $api = array('status' => 'error','message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล');
        }

    }
   

    echo json_encode($api);