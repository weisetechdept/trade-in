<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
 
    function DateThai($strDate)
    {
        $strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute น.";
    }

    function User($id){
        global $db;
        $user = $db->where('user_id',$id)->getOne('user');
        return $user['user_nickname'];
    }

    if($_GET['action'] == 'event'){
        $variable = $db->where('even_parent',$_GET['id'])->get('event');
        foreach ($variable as $value) {

            $api['event'][] = array(
                'id' => $value['even_id'],
                'detail' => $value['even_detail'],
                'date' => $value['even_date'],
                'parent' => $value['even_parent']
            );
            
        }

        $user = $db->where('user_status',1)->get('user');
        foreach ($user as $value) {
            $api['user'][] = array(
                'id' => $value['user_id'],
                'name' => $value['user_nickname']
            );
        }
    }

    if($_GET['action'] == 'fetch'){

        $db->join('car_stock u', 'u.cast_id = e.even_parent','RIGHT');
        $variable = $db->where('even_status',0)->where('even_date',date('Y-m-d'),">=")->get('event e');

        foreach ($variable as $value) {

            $db->join('car_image i', 'i.cari_id = s.cast_thumb','RIGHT');
            $img = $db->where('cast_id',$value['cast_id'])->getOne('car_stock s');

            if($img['cast_thumb'] == '0'){
                $thumb = 'https://dummyimage.com/600x400/c4c4c4/fff&text=no-image';
            } else {
                $thumb = $img['cari_link'];
            }

            $api['data'][] = array(
                $value['even_id'],
                $value['even_detail'],
                DateThai($value['even_date']),
                'คุณ '.$value['cast_seller_name'].' (ID '.$value['even_parent'].')',
                User($value['even_owner']),
                $thumb,
                $value['cast_id']
            );
        }


    }

    echo json_encode($api);