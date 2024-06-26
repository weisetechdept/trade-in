<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['tin_admin'] != true){
        $api = array('status' => 'error', 'message' => 'Permission denied');
    } else {

        $member = $db->get('partner');

        foreach ($member as $value) {
            $api['data'][] = array(
                $value['part_id'],
                $value['part_line_img'],
                $value['part_fname'].' '.$value['part_lname'],
                $value['part_bus_name'],
                $value['part_tel'],
                $value['part_bus_id'],
                $value['part_group'],
                $value['part_status'],
                date('d/m/Y H:i:s', strtotime($value['part_datetime']))
            );
        }

    }

    echo json_encode($api);

    