<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));
    $id = $request->id;

    $db->join('car_image i','o.off_parent=i.cari_parent','LEFT');
    $offered = $db->where('off_vender',$id)->get('offer o');
    foreach($offered as $offer){

        $api['offered'][] = array(
            'id' => $offer['off_id'],
            'vender' => $offer['off_vender'],
            'price' => number_format($offer['off_price']),
            'datetime' => date('d/m/Y H:i:s', strtotime($offer['off_datetime'])),
            'img' => $offer['cari_link']
        );
        
    }

    echo json_encode($api);

        