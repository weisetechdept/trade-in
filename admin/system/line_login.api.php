<?php  
     session_start();
     require_once '../../db-conn.php';
     date_default_timezone_set("Asia/Bangkok");

     $request = json_decode(file_get_contents('php://input'));
     $uid = $request->userId;

     $admin = $db->where('user_line_uid',$uid)->where('user_permission','admin')->getOne('user');

     if($admin){
        $_SESSION['tin_admin'] = true;
        $_SESSION['user_id_admin'] = $admin['user_id'];
        
        $api = array(
            'status' => '200',
            'message' => 'Success to login'
        );

    }else{
        $api = array(
            'status' => '400',
            'message' => 'Permission Denied'
        );
    }

    echo json_encode($api);
