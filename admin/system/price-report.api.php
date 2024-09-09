<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

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

    $data = $db->orderBy('cast_id','DESC')->get('car_stock',20);
    foreach($data as $value){

        if(!empty($value['cast_price'])){

            $best_off = getOffer($value['cast_id']);

            $api['data'][] = array(
                $value['cast_id'],
                number_format($value['cast_price'], 0),
                number_format($best_off['price'], 0),
                number_format(($best_off['price'] / $value['cast_price']) * 100, 0).' %',
                $best_off['partner'],
                getName($value['cast_sales_parent_no']),
                getTeam($value['cast_sales_parent_no']),
                '',
            );

        }

        

    }

    echo json_encode($api);

    

    


