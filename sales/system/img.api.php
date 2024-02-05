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
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}

    $db->join("car_stock c", "c.cast_id=i.cari_parent", "LEFT");
    $db->where("c.cast_id",$_GET['u'])->where('i.cari_status',1);
    $img = $db->get("car_image i", null, "i.cari_link , i.cari_link_500, i.cari_group, i.cari_parent, i.cari_status, i.cari_datetime,i.cari_id");

    
    foreach ($img as $value) {
        
        $api['img'][] = array('link' => $value['cari_link'],
        'link_500' => $value['cari_link_500'],
        'id' => $value['cari_id'],
        'datetime' => DateThai($value['cari_datetime']));
        
    }

    print_r(json_encode($api));