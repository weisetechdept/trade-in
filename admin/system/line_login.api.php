<?php  
     session_start();
     require_once '../../db-conn.php';
     date_default_timezone_set("Asia/Bangkok");

     $request = json_decode(file_get_contents('php://input'));

    if(!isset($request->userId) || !isset($request->userImg)){
        $api = array(
            'status' => '400',
            'message' => 'Permission Denied'
        );
        echo json_encode($api);
        exit();

    } else {

        $uid = $request->userId;
        $userImg = $request->userImg;

        $admin = $db->where('user_line_uid',$uid)->where('user_permission','admin')->where('user_status','1')->getOne('user');

        if($admin){

            $update = array(
                'user_line_img' => $userImg
            );
            $up = $db->where('user_id',$admin['user_id'])->update('user',$update);
            if($up){

                $_SESSION['tin_admin'] = true;
                $_SESSION['user_id_admin'] = $admin['user_id'];
                $_SESSION['adname_name'] = $admin['user_nickname']; 
                
                $api = array(
                    'status' => '200',
                    'message' => 'Success to login'
                );
                
            } else {
                $api = array(
                    'status' => '400',
                    'message' => 'Login not Success'
                );
            }

        } else {
            $api = array(
                'status' => '400',
                'message' => 'Permission Denied'
            );
        }

    }

     

    echo json_encode($api);
