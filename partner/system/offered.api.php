<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

        $db->join('car_stock s','s.cast_id = o.off_parent','RIGHT'); 
        $new = $db->where('off_vender',1)->get('offer o');

        if(count($new) == 0){
            $api['data'] = array();
        } else {
            foreach ($new as $value) {
                $thumbnail = $db->where('cari_parent',$value['cast_id'])->where('cari_status',1)->getOne('car_image');
                $api['data'][] = array(
                    base64_encode($value['cast_id']),
                    $thumbnail['cari_link'] ,
                    $value['off_price'],
                    $value['cast_id']
                );
            }
        }

    echo json_encode($api);