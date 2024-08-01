<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    function getTeam($uid){
        global $db_nms;
        $team = $db_nms->get('db_user_group');
        foreach($team as $t){
            $tm = json_decode($t['leader']);
            if(in_array($uid,$tm)){
                return $t['detail'];
            } 
        }
    }

    echo getTeam(271);
    
/*
    $team = $db_nms->where('name',getTeam(271))->getOne('db_user_group');
    echo $team['detail'];

    $stock = $db->where('cast_datetime',[date('Y-m-').'01 00:00:00',date('Y-m-').'31 00:00:00'],'BETWEEN')->get('car_stock');
    foreach ($stock as $value) {
        echo $value['cast_id'].'<br>';
    }
*/
