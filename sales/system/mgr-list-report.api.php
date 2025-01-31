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
                    $team_merge = array_merge(json_decode($value['leader']),json_decode($value['detail']));
                    foreach($team_merge as $emp){
                        $team[] = $emp;
                    }
                }
            }
            return array_unique($team);
        }

        $month = $_GET['month'];
        $year = $_GET['year'];

        $date_form = $_GET['year'].'-'. $_GET['month'].'-01';
        $date_to = $_GET['year'].'-'. $_GET['month'].'-31';
    
        $db->join('car_stock c', "f.find_id=c.cast_car", "LEFT");
        $db->groupBy('c.cast_id');
        //$db->where('c.cast_datetime', Array($year.'-'.$month.'-01', $year.'-'.$month.'-31'), 'BETWEEN');

        $db->where(cast_datetime, $date_form , '>=')->where(cast_datetime, $date_to , '<=');
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

            foreach ($count as $key => $value) {
                $wait[$key] = 0;
                $sold[$key] = 0;
                $cancel[$key] = 0;
            }
            
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
                if($value['cast_status'] == '0' || $value['cast_status'] == '1' || $value['cast_status'] == '2' ){
                    $wait[$sales['first_name']]++;
                }

                if($value['cast_status'] == '4'){
                    $sold[$sales['first_name']]++;
                }

                if($value['cast_status'] == '3'){
                    $cancel[$sales['first_name']]++;
                }

                $sales_id[$sales['first_name']] = $sales['id'];
                
            }
            
            $all_wait = 0;
            $all_sold = 0;
            $all_cancel = 0;

            foreach ($wait as $key => $value) {
                $api['team'][] = array('id' => $sales_id[$key],'name'=> $key, 'wait' => $value, 'sold' => $sold[$key], 'cancel' => $cancel[$key]);
            }
        } else {
            $api['team'] = '';
        }

    print_r(json_encode($api));