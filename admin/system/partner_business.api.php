<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['tin_admin'] != true){
        $api = array('status' => 'error', 'message' => 'Permission denied');
    } else {

        $busi = $db->get('partner_bus');

        foreach ($busi as $value) {

            $count_mem = $db->where('part_bus_id',$value['busi_id'])->getValue('partner','count(*)');

            $api['data'][] = array(
                $value['busi_id'],
                $value['busi_name'],
                $value['busi_status'],
                date('d/m/Y H:i:s', strtotime($value['busi_datetime'])),
                $count_mem
            );
        }

    }

    echo json_encode($api);

    