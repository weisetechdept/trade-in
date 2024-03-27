<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }

    function getTeam($uid){
        global $db_nms;
        $team = $db_nms->get('db_user_group');
        foreach($team as $t){
            $team_data = json_decode($t['detail']);
            if(in_array($uid,$team_data)){
                return $t['name'];
            } 
        }
    }

    function DateThai($strDate)
	{
		$strYear = date("y",strtotime($strDate));
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
	
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

    $db->join('car_stock c', "f.find_id=c.cast_car", "INNER");
    $stock = $db->get("finance_data f", null ,"c.cast_id,c.cast_license,f.find_brand,f.find_serie,f.find_section,c.cast_color,c.cast_price,c.cast_sales_parent,c.cast_sales_team,c.cast_status,cast_sales_parent_no,cast_datetime");


    foreach ($stock as $value) {
        if(empty($value['cast_sales_parent_no'])){
            $data_owner = $value['cast_sales_parent'].' - '.$value['cast_sales_team'];
        } else {
            $sales = $db_nms->where('id', $value['cast_sales_parent_no'])->getOne('db_member');
            $data_owner = $sales['first_name'].' - '.getTeam($value['cast_sales_parent_no']);
        }


        $api['data'][] = array($value['cast_id'],
            $value['cast_license'],
            $value['find_brand'].' '.$value['find_serie'].' '.$value['find_section'],
            $value['cast_color'],
            number_format($value['cast_price']),
            $data_owner,
            $value['cast_status'],
            DateThai($value['cast_datetime'])
        );
    }

    print_r(json_encode($api));