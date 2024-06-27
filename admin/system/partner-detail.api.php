<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
/*
    if($_SESSION['tin_admin'] != true){
        $api = array('status' => 'error', 'message' => 'Permission denied');
    } else {
*/
        $id = $_GET['id'];

        $member = $db->where('part_id',$id)->getOne('partner');

    
        $api['detail'] = array(
            'id' => $member['part_id'],
            'profile_img' => $member['part_line_img'],
            'name' => $member['part_fname'].' '.$member['part_lname'],
            'busi_name' => $member['part_bus_name'],
            'tel' => $member['part_tel'],
            'busi_match' => $member['part_bus_id'],
            'group' => $member['part_group'],
            'status' => $member['part_status'],
            'create_date' => date('d/m/Y H:i:s', strtotime($member['part_datetime']))
        );
        
/*
    }
*/
    echo json_encode($api);

    