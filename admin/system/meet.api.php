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

        $db->join('car_stock u', 'u.cast_id = e.even_parent','RIGHT');
        $variable = $db->where('even_status',0)->get('event e');

        foreach ($variable as $value) {

            $db->join('car_image i', 'i.cari_id = s.cast_thumb','RIGHT');
            $img = $db->getOne('car_stock s');

            if($img['cast_thumb'] == '0'){
                $thumb = 'https://dummyimage.com/600x400/c4c4c4/fff&text=no-image';
            } else {
                $thumb = $img['cari_link'];
            }

            $api['data'][] = array(
                $value['even_id'],
                $value['even_detail'],
                DateThai($value['even_date']),
                'คุณ '.$value['cast_seller_name'].', ID '.$value['even_parent'],
                'AA',
                $thumb,
                $value['cast_id']
            );
        }


    }

    echo json_encode($api);