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

    $id = $_GET['u'];

    $chk_data = $db->where('cast_id', $id)->getOne('car_stock');
    
    if($_SESSION['tin_login'] != true || $chk_data['cast_sales_parent_no'] != $_SESSION['tin_user_id'] ){
        $api['status'] = '404';
    } else {

    if(!empty($id)){

        $db->join('car_stock c', "f.find_id=c.cast_car", "RIGHT");
        $db->where('c.cast_id', $id);
        $stock = $db->getOne("finance_data f", null, "f.find_id, f.find_brand, f.find_serie, f.find_section, f.find_color, f.find_price, f.find_status, c.cast_id, c.cast_license, c.cast_color, c.cast_price, c.cast_sales_parent, c.cast_sales_team, c.cast_status");

        $offno = 1;
        $offer = $db->where('off_parent', $stock['cast_id'])->get('offer');
        foreach($offer as $value){
            $api['offer'][] = array(
                'no' => $offno,
                'vendor' => $value['off_vender'],
                'date' => DateThai($value['off_datetime']),
                'price' => number_format($value['off_price'])
            );
            $offno++;
        }

        if($stock['cast_fin'] == 1){
            $p_fin = 'ติดไฟแนนซ์ '.$stock['cast_loan'];
        } elseif($stock['cast_fin'] == 2) {
            $p_fin = 'ปลอดภาระ';
        }

        if($stock['cast_ready'] == 1){
            $p_ready = 'พร้อมขายทันที';
        } elseif($stock['cast_ready'] == 2) {
            $p_ready = 'รอรถใหม่จบก่อน';
        }

        $api['car'] = array('id' => $stock['cast_id'],
            'license' => $stock['cast_license'],
            'brand' => $stock['find_brand'],
            'serie' => $stock['find_serie'],
            'section' => $stock['find_section'],
            'car_year' => $stock['find_year'],
            'reg_year' => $stock['cast_year'],
            'color' => $stock['cast_color'],
            'price' => number_format($stock['cast_price']),
            'trade_price' => number_format($stock['cast_trade_price']),
            'tlt_price' => number_format($stock['find_price']),
            'sales' => $stock['cast_sales_parent'].' - '.$stock['cast_sales_team'],
            'status' => $stock['cast_status'],
            'transmission' => $stock['cast_transmission'],
            'option' => $stock['cast_option'],
            'condition' => $stock['cast_condition'],
            'vin' => $stock['cast_vin'],
            'mileage' => number_format($stock['cast_mileage']),
            'tel' => '0'.$stock['cast_tel'],
            'cal_price' => $stock['cast_price'],
            'cal_tlt_price' => $stock['find_price'],
            'vat' => $stock['cast_vat'],
            'sellername' => $stock['cast_seller_name'],

            'pv' => $stock['cast_pv'],
            'fin' => $p_fin,
            'ready' => $p_ready
        );

    }
        
    }
    

    

    print_r(json_encode($api));