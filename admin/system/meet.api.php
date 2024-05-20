<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_GET['action'] == 'event'){
        $variable = $db->get('event');
        foreach ($variable as $value) {

            $api[] = array(
                'id' => $value['even_id'],
                'detail' => $value['even_detail'],
                'date' => $value['even_date'],
                'parent' => $value['even_parent']
            );
            
        }
    }

    if($_GET['action'] == 'fetch'){

        $db->join('user u', 'u.user_id = e.even_parent', 'RIGHT');
        $variable = $db->where('even_status',0)->get('event e');
        foreach ($variable as $value) {
            $api['data'][] = array(
                $value['even_id'],
                $value['even_detail'],
                $value['even_date'],
                'คุณ '.$value['cast_seller_name'].' ID '.$value['even_parent'],
            );
        }

    }

    echo json_encode($api);