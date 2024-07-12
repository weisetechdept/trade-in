<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
/*
    if($_SESSION['tin_admin'] != true){
        $api = array('status' => 'error', 'message' => 'Permission denied');
    } else {
*/
    $request = json_decode(file_get_contents('php://input'));
    $id = $request->id;

    $user = $db->where('part_id',$id)->getOne('partner');
    if($user['part_bus_id'] == '0'){

        $api = array(
            'status' => 'error',
            'message' => 'Please add business information first'
        );

    } else {

        if($user['part_status'] == '0'){

            $verify = array(
                'part_status' => '1'
            );
            $db->where('part_id',$id);
            if($db->update('partner',$verify)){
                $api = array('status' => 'success', 'message' => 'Partner verified');
            } else {
                $api = array('status' => 'error', 'message' => 'Failed to verify partner');
            }

        } elseif($user['part_status'] == '1'){

            $verify = array(
                'part_status' => '0'
            );
            $db->where('part_id',$id);
            if($db->update('partner',$verify)){
                $api = array('status' => 'success', 'message' => 'Partner unverified');
            } else {
                $api = array('status' => 'error', 'message' => 'Failed to unverify partner');
            }

        } else {
            $api = array('status' => 'error', 'message' => $db->getLastErrno());
        }

    }

/*
    }
*/

     echo json_encode($api);