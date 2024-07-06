<?php 
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_GET['get'] == 'all'){

        $db->join('finance_data f','s.cast_car = f.find_id','INNER');
        $new = $db->where('cast_link_public',1)->get('car_stock s');

        foreach ($new as $value) {
            $thumbnail = $db->where('cari_parent',$value['cast_id'])->where('cari_status',1)->getOne('car_image');
            $api['data'][] = array(
                base64_encode($value['cast_id']),
                $thumbnail['cari_link'] ,
                $value['find_serie'].' '.$value['find_section'],
                $value['cast_id'],
                number_format($value['cast_mileage']),
                $value['cast_transmission'],
                $value['cast_year']
            );
        }

    } else {

        $db->join('finance_data f','s.cast_car = f.find_id','INNER');
        $db->where('cast_datetime',array(date('Y-m-d').' 00:00:00',date('Y-m-d').' 23:59:59'),'BETWEEN');
        $new = $db->where('cast_link_public',1)->where('cast_status',array(1,2),'IN')->get('car_stock s');

        if(count($new) == 0){
            $api['data'] = array();
        } else {

            foreach ($new as $value) {
                $thumbnail = $db->where('cari_parent',$value['cast_id'])->where('cari_status',1)->getOne('car_image');
                $api['data'][] = array(
                    base64_encode($value['cast_id']),
                    $thumbnail['cari_link'] ,
                    $value['find_serie'].' '.$value['find_section'],
                    $value['cast_id'],
                    number_format($value['cast_mileage']),
                    $value['cast_transmission'],
                    $value['cast_year']
                );
            }

        }

    }

    echo json_encode($api);