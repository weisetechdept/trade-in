<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $id = $_GET['id'];

    $topic = $db->where('job_id',$id)->getOne('job');

    $api['heading'] = $topic['job_name'];

    $job = $db->where('jobm_parent',$id)->get('job_match');
    foreach ($job as $value) {

        $car = json_decode($value['jobm_car']);
        $api['job'][] = array('id' => $value['jobm_id'], 'name'=> $value['jobm_name'], 'count' => count($car), 'stock'=> $value['jobm_car']);
        
    }
    echo json_encode($api);