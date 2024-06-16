<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    

    $job = $db->get('job');
    foreach ($job as $value) {
        $api['job'][] = array('id' => $value['job_id'], 'name'=> $value['job_name'], 'detail'=> $value['job_detail'], 'status' => $value['job_status'], 'date' => $value['job_datetime']);
        
    }
    echo json_encode($api);