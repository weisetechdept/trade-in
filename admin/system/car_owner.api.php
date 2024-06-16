<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }

        $id = $_GET['id'];
        
        $sales = $db_nms->where('verify',1)->where('status',array('user','leader'),'IN')->orderBy('id','ASC')->get('db_member');
        
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

        $custData = $db->where('cast_id',$id)->getOne('car_stock');
        $carData = $db->where('find_id',$custData['cast_car'])->getOne('finance_data');

        $api['custData'] = array(
            'id' => $id,
            'seller_name' => $custData['cast_seller_name'],
            'car' => $carData['find_brand'].' '.$carData['find_serie'].' '.$carData['find_section']
        );

        $api['sales'][0] = array(
            'id' => '0',
            'text' => '= โปรดเลือกพนักงานขาย ='
        );

        foreach($sales as $s){

            if($s['nickname'] == ''){
                $nickname = '';
            } else {
                $nickname = ' ( '.$s['nickname'].' )';
            }

            if($s['status'] == 'leader'){
                $leader = ' (ผจก.ทีม)';
            } else {
                $leader = '';
            }

            $api['sales'][] = array(
                'id' => $s['id'],
                'text' => $s['first_name'].' '.$s['last_name'].''.$nickname.' ทีม '.getTeam($s['id']).''.$leader
            );
        }
    

    echo json_encode($api);