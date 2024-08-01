<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['tin_admin'] != true){
        $api = array('status' => 'error', 'message' => 'Permission denied');
    } else {

        $member = $db->where('user_permission','admin')->get('user');
        foreach ($member as $value) {
            $api['data'][] = array(
                $value['user_id'],
                $value['user_line_img'],
                $value['user_nickname'],
                $value['user_permission'],
                $value['user_status'],
                date('d/m/Y H:i:s', strtotime($value['user_datetime']))
            );
        }

    }
    echo json_encode($api);

    