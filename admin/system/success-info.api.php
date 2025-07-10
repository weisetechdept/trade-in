<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    
    if($_SESSION['tin_admin'] != true){
        echo json_encode(array('error' => 'Unauthorized access'));
        exit();
    } else {

            $db->join('partner_bus b', "p.part_bus_id=b.busi_id", "LEFT");
            $db->groupBy('p.part_id');
            $partner = $db->where('part_group',2)->where('part_status',1)->get('partner p');

            function DateThai($strDate)
            {
                $strYear = date("y",strtotime($strDate));
                $strMonth= date("n",strtotime($strDate));
                $strDay= date("j",strtotime($strDate));
                $strHour= date("H",strtotime($strDate));
                $strMinute= date("i",strtotime($strDate));
                $strSeconds= date("s",strtotime($strDate));

                $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                $strMonthThai=$strMonthCut[$strMonth];

                $date1 = new DateTime($strDate);
                $date2 = new DateTime();
                $interval = $date1->diff($date2);

                return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute (ผ่านมา $interval->days วัน)";
            }

            function getSaleName($uid){
                global $db_nms;

                $teamName = '-';
                $sale = $db_nms->where('id', $uid)->getOne('db_member', null,'first_name');
                $team = $db_nms->get('db_user_group', null, 'name,detail,leader');
            
                foreach($team as $t){
                    $tm = array_merge(json_decode($t['detail']),json_decode($t['leader']));
                    if(in_array($uid,$tm)){
                        $teamName =  $t['name'];
                    } 
                }

                return $sale ? $sale['first_name'].' '.$sale['last_name'].' ('.$teamName.')' : 'Unknown';
            }

            $db->join('finance_data fd', 'cs.cast_car=fd.find_id', 'RIGHT');
            $c_date = $db->where('cast_id',$_GET['id'])->getOne('car_stock cs','cast_datetime,find_brand,find_serie,find_section,find_year,cast_sales_parent');

            $api['jobData'] = array();

            $api['jobData'] = array(
                'id' => $_GET['id'],
                'partner' => 0,
                'price' => '',
                'commission' => '',
                'newcar' => 0,
                'newcar_detail' => '0',
                'date' => '0000-00-00',
                'car' => $c_date['find_year'].' '.$c_date['find_brand'].' '.$c_date['find_serie'].' '.$c_date['find_section'],
                'sales' =>  getSaleName($c_date['cast_sales_parent']),
                'create_date' => DateThai($c_date['cast_datetime']),
                'other_detail' => '== ยังไม่เปิดใช้งาน =='
            );


            $chk = $db->where('succ_parent',$_GET['id'])->getOne('success');

        

            if($chk){
                $api['jobData'] = array(
                    'id' => $chk['succ_parent'],
                    'partner' => $chk['succ_partner'],
                    'price' => $chk['succ_price'],
                    'commission' => $chk['succ_commission'],
                    'newcar' => $chk['succ_newcar'],
                    'newcar_detail' => $chk['succ_newcar_detail'],
                    'date' => $chk['succ_date'],
                    'detail' => $chk['succ_comment'],
                    'car' => $c_date['find_year'].' '.$c_date['find_brand'].' '.$c_date['find_serie'].' '.$c_date['find_section'],
                    'sales' =>  getSaleName($c_date['cast_sales_parent']),
                    'create_date' => DateThai($c_date['cast_datetime']),
                    'other_detail' => '== ยังไม่เปิดใช้งาน =='
                );
            }

            $db->join('partner_bus pb', 'pn.part_bus_id=pb.busi_id', 'LEFT');
            $partnerData = $db->where('part_status',1)->get('partner pn');

            foreach($partnerData as $p){
                $api['data'][] = array(
                    'id' => $p['part_id'],
                    'name' => $p['part_fname'].' ('.$p['busi_name'].')'
                );
            }



            echo json_encode($api);
    }