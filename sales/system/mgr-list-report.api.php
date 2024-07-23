<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    
    //$user_id = $_SESSION['tin_user_id'];

    if($_SESSION['tin_permission'] !== 'leader') {
        header("location: /404");
    }

    $user_id = $_SESSION['tin_user_id'];

    function mgr($data){
        global $db_nms;
        $group = $db_nms->get('db_user_group');
        foreach($group as $value){
            $chk = in_array($data, json_decode($value['leader']));
            if($chk){
                foreach(json_decode($value['detail']) as $emp){
                    $team[] = $emp;
                }
            }
        }
        return array_unique($team);
    }

    
    
        $db->join('car_stock c', "f.find_id=c.cast_car", "RIGHT");
        $stock = $db->where('c.cast_sales_parent_no',mgr($user_id),'IN')->get("finance_data f", null ,"c.cast_id,c.cast_license,f.find_brand,f.find_serie,f.find_section,c.cast_color,c.cast_price,c.cast_sales_parent,c.cast_sales_team,c.cast_status,cast_sales_parent_no");
        
        $count = array();
        $team = array();
        foreach ($stock as $value) {
            $sales = $db_nms->where('id', $value['cast_sales_parent_no'])->getOne('db_member');
            $team[$sales['first_name']] = isset($team[$sales['first_name']]) ? $team[$sales['first_name']] + 1 : 1;
        }
        $count = $team;
        $api = array();

        if(!empty($stock)){
            foreach ($stock as $value) {
                
                $sales = $db_nms->where('id',$value['cast_sales_parent_no'])->getOne('db_member');
/*
                $api['data'][] = array($value['cast_id'],
                    $value['cast_status'],
                    substr($value['find_brand'].' '.$value['find_serie'].' '.$value['find_section'],0,25),
                    $value['cast_color'],
                    number_format($value['cast_price']),
                    $thumbnail,
                    $sales['first_name']
                );
*/
                $count[$sales['first_name']]++;
            }
            foreach ($count as $key => $value) {
                $api['team'][] = array('name'=> $key, 'customer' => $value);
            }
        } else {
            $api['team'] = '';
        }

    print_r(json_encode($api));