<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_GET['get'] == 'current'){

        $api['month_prv'] = array();
        for($i=0; $i<6; $i++){
            $api['month_prv'][] = array(
                'name' => date('F Y', strtotime($date_from.' -'.$i.' month')),
                'date_from' => date('Y-m-01', strtotime($date_from.' -'.$i.' month')),
                'date_to' => date('Y-m-t', strtotime($date_from.' -'.$i.' month'))
            );
        }

    }

    if($_GET['get'] == 'data' && $_GET['date'] !== '0'){

        $selected = $_GET['date'];

        $start = date('Y-m-01', strtotime($selected));
        $end = date('Y-m-t', strtotime($selected));

        $price = $_GET['price'];

        function getOffer($id) {
            global $db;

            $db->join('partner p', 'o.off_vender = p.part_id', 'LEFT');
            $data = $db->where('off_parent',$id)->orderBy('off_price','DESC')->getOne('offer o');
            $arr = array(
                'price' => $data['off_price'],
                'partner' => $data['part_fname'].' - '.$data['part_bus_name']
            );
            return $arr;
        }

        function getName($id){
            global $db_nms;
            $data = $db_nms->where('id',$id)->getOne('db_member');
            return $data['first_name'];
        }

        function getTeam($uid){
            global $db_nms;
            $team = $db_nms->get('db_user_group');
            foreach($team as $t){
                $tm = array_merge(json_decode($t['detail']),json_decode($t['leader']));
                if(in_array($uid,$tm)){
                    return $t['name'];
                } 
            }
        }

        $db->join('car_image i', 'c.cast_id = i.cari_parent', 'RIGHT')->groupBy('c.cast_id');
        $data = $db->where('cast_datetime', array($start, $end), 'BETWEEN')->where('cast_status',array('0','1','2','3','4'),"IN")->get('car_stock c');
        foreach($data as $value){
        
            $best_off = getOffer($value['cast_id']);
            $diff = $best_off['price'] - $value['cast_price'];
        
                
            if(!empty($value['cast_price']) && $diff >= $price){

                $api['data'][] = array(
                    $value['cast_id'],
                    number_format($value['cast_price'], 0),
                    number_format($best_off['price'], 0),
                    number_format($best_off['price'] - $value['cast_price']),
                    number_format(($best_off['price'] / $value['cast_price']) * 100, 0).' %',
                    $best_off['partner'],
                    getName($value['cast_sales_parent_no']),
                    getTeam($value['cast_sales_parent_no']),
                    $value['cast_datetime'],
                    $value['cari_link']
                );
        
            }
        
        }
    } else {
        $api['data'] = array();
    }

    echo json_encode($api);