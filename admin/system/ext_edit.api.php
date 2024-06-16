<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }

    $id = $_GET['id'];

    $db->join('car_stock c', "f.find_id=c.cast_car", "RIGHT");
    $stock = $db->get("finance_data f", null, "c.cast_id, f.find_brand, f.find_serie, f.find_section");


    foreach ($stock as $value) {

        $api['car'][] = array('id' => $value['cast_id'],
            'brand' => $value['find_brand'],
            'serie' => $value['find_serie'],
            'section' => $value['find_section']
        );
    }

    echo json_encode($api);
