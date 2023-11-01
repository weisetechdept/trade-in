<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }


    $db->join('car_stock c', "f.find_id=c.cast_car", "INNER");
    $stock = $db->get("finance_data f", null ,"c.cast_id,c.cast_license,f.find_brand,f.find_serie,f.find_section,c.cast_color,c.cast_price,c.cast_sales_parent,c.cast_sales_team,c.cast_status");

    foreach ($stock as $value) {
        $api['data'][] = array($value['cast_id'],$value['cast_license'],$value['find_brand'].' '.$value['find_serie'].' '.$value['find_section'],$value['cast_color'],number_format($value['cast_price']),$value['cast_sales_parent'].' - '.$value['cast_sales_team'],$value['cast_status']
        );
    }

    print_r(json_encode($api));