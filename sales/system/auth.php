<?php
    session_start();
    require_once '../../db-conn.php';

    $request = json_decode(file_get_contents('php://input'));
    $userId = $request->userId;

    if($userId !== null) {

        $profile = $db_nms->where('line_usrid',$userId)->getOne('db_member');
        //echo json_encode($profile);

        if($profile['verify'] == '1') {

            $_SESSION['tin_user_id'] = $profile['id'];
            $_SESSION['tin_permission'] = $profile['status'];
            echo json_encode(array('status' => '200', 'permission' => $profile['status']));

        } else {
            echo json_encode(array('status' => '400'));
            unset($_SESSION['tin_user_id']);
        }
    } else {
        echo json_encode(array('status' => '400'));
        unset($_SESSION['tin_user_id']);

    }

?>