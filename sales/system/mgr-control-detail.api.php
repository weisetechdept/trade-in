<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $sales = $_GET['sales'];
    $month = $_GET['month'];
    $year = $_GET['year'];
    $status = $_GET['status'];

    if($status == "wait"){
        $s = array('0','1','2');
    } elseif($status == "sold") {
        $s = array('4');
    } elseif($status == "cancel") {
        $s = array('3');
    }

    $form_date = $year."-".$month."-01";
    $to_date = $year."-".$month."-31";

    $api = array();

    $db->join('car_image i','s.cast_id = i.cari_parent','LEFT');
    $db->join('finance_data f','f.find_id = s.cast_car','LEFT');
    $db->where('cast_sales_parent_no',$sales)->where('cast_datetime',Array($form_date,$to_date),'BETWEEN')->where('cast_status',$s,'IN');
    $stock = $db->groupBy('cast_id')->get('car_stock s');
    foreach($stock as $s){
        $api['data'][] = array(
            $s['cast_id'],
            $s['cari_link'],
            $s['cast_year'].' '.$s['find_serie'],
        );
    }

    echo json_encode($api);

