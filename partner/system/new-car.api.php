<?php 
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $db->join('finance_data f','s.cast_car = f.find_id','INNER');
    $new = $db->where('cast_link_public',1)->where('cast_datetime',array(date('Y-m-d').' 00:00:00',date('Y-m-d').' 23:59:59'),'BETWEEN')->get('car_stock s');

    foreach ($new as $value) {
        $thumbnail = $db->where('cari_parent',$value['cast_id'])->getOne('car_image');
        $api['data'][] = array(
            base64_encode($value['cast_id']),
            $thumbnail['cari_link'] ,
            $value['find_serie'].' '.$value['find_section'],
            '',
            number_format($value['cast_mileage']),
            $value['cast_transmission'],
            $value['cast_year']
        );
    }

    echo json_encode($api);