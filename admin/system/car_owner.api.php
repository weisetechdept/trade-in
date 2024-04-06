<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

        $id = '515';


        $custData = $db->where('cast_id',$id)->getOne('car_stock');

        $sales = $db_nms->where('verify',1)->where('status','user')->orderBy('id','ASC')->get('db_member');
        
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

        $api['custData'] = array(
            'id' => $id,
            'seller_name' => $custData['cast_seller_name '],
            'car' => $custData['cast_car']
        );


        foreach($sales as $s){

            if($s['nickname'] == ''){
                $nickname = '';
            } else {
                $nickname = ' ( '.$s['nickname'].' ) ';
            }

            $api[] = array(
                'id' => $s['id'],
                'text' => $s['first_name'].' '.$s['last_name'].''.$nickname.'ทีม '.getTeam($s['id'])
            );
        }
    

    echo json_encode($api);