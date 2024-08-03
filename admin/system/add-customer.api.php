<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $db->join("finance_data f","f.find_id = s.cast_car","LEFT");
    $getCar = $db->where('cast_status',array(0,1,2,3,4,10),"IN")->get('car_stock s',null,'cast_id,cast_year,find_brand,find_serie');

    $data['car'][] = array(
        'id' => '0',
        'text' => 'เลือกรถยนต์ที่ต้องการ',
    );

    foreach ($getCar as $value) {
        $data['car'][] = array(
            'id' => $value['cast_id'],
            'text' => 'รถยนต์ ID = '.$value['cast_id'].' - '.$value['cast_year'].' '.$value['find_brand'].' '.$value['find_serie'],
        );
    }

    echo json_encode($data);