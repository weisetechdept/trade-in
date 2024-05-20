<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $variable = $db->get('event');
    foreach ($variable as $value) {

        $api[] = array(
            'id' => $value['even_id'],
            'detail' => $value['even_detail'],
            'date' => $value['even_date'],
            'parent' => $value['even_parent']
        );
        
    }

    echo json_encode($api);