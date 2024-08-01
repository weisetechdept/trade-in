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

        //$partner = $db->where('part_line_uid',$uid)->where('part_status','1')->getOne('partner');

        $partner = $db->where('part_line_uid',$uid)->getOne('partner');

        if($partner){

            $update = array(
                'part_line_img' => $userImg
            );
            $up = $db->where('part_id',$partner['part_id'])->update('partner',$update);
            if($up){

                if($partner['part_status'] == 1){

                    $_SESSION['tin_partner'] = true;
                    $_SESSION['partner_id'] = $partner['part_id'];
                    $_SESSION['partner_name'] = $partner['part_fname'].' '.$partner['part_lname'];
                    $_SESSION['partner_img'] = $userImg;
                    
                    $api = array(
                        'status' => '200',
                        'message' => 'Success to login'
                    );

                } else {
                    $api = array(
                        'status' => '401',
                        'message' => 'Please wait for approval'
                    );
                }
                
                
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
