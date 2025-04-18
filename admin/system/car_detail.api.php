<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
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

    $id = $_GET['u'];

    if(!empty($id)){

        $db->join('car_stock c', "f.find_id=c.cast_car", "RIGHT");
        $db->where('c.cast_id', $id);
        $stock = $db->getOne("finance_data f", null, "f.find_id, f.find_brand, f.find_serie, f.find_section, f.find_color, f.find_price, f.find_status, c.cast_id, c.cast_license, c.cast_color, c.cast_price, c.cast_sales_parent, c.cast_sales_team, c.cast_status,cast_seller_name,cast_link_public,cast_sales_parent_no");

        if($stock['cast_type'] == '1'){
            $typeOfCar = 'เก๋ง (SEDAN,HB,SUV,MPV,PPV)';
        } else if($stock['cast_type'] == '2'){
            $typeOfCar = 'รถกระบะ';
        } else if($stock['cast_type'] == '3') {
            $typeOfCar = 'รถตู้';
        }

        if($stock['cast_seat'] == '1'){
            $seatOfCar = '1 แถว';
        } elseif($stock['cast_seat'] == '2'){
            $seatOfCar = '2 แถว';
        } elseif($stock['cast_seat'] == '3'){
            $seatOfCar = '3 แถว';
        } elseif($stock['cast_seat'] == '4'){
            $seatOfCar = 'มากกว่า 3 แถว';
        } 

        if($stock['cast_door'] == '1'){
            $doorOfCar = '2 ประตู';
        } elseif($stock['cast_door'] == '2'){
            $doorOfCar = '3 ประตู';
        } elseif($stock['cast_door'] == '3'){
            $doorOfCar = '4 ประตู';
        } elseif($stock['cast_door'] == '4'){
            $doorOfCar = '5 ประตู';
        }

        $fuelData = json_decode($stock['cast_fuel']);
        $fuel = '';
        foreach ($fuelData as $f) {
            if ($f == '1') {
                $fuel .= 'เบนซิน, ';
            } elseif ($f == '2') {
                $fuel .= 'ดีเซล, ';
            } elseif ($f == '3') {
                $fuel .= 'LPG, ';
            } elseif ($f == '4') {
                $fuel .= 'NGV, ';
            } elseif ($f == '5') {
                $fuel .= 'EV (ไฟฟ้า), ';
            }
        }
        $fuel = rtrim($fuel, ', ');

       
        $salesData = $db_nms->where('id',$stock['cast_sales_parent_no'])->getOne('db_member');
        if(empty($salesData)){
            $salesData = 'ไม่ผู้ดูแล';
        } else {
            $salesData = $salesData['first_name'].' '.$salesData['last_name'].' - ทีม '.getTeam($stock['cast_sales_parent_no']);
        }

        if($stock['cast_fin'] == '1'){
            $loanAmount = is_numeric($stock['cast_loan']) ? number_format($stock['cast_loan']) : 0;
            $fin = 'ติดไฟแนนซ์ - '. $loanAmount .' บาท';
        } elseif($stock['cast_fin'] == '2') {
            $fin = 'ปลอดภาระ';
        }

        if($stock['cast_ready'] == '1'){
            $ready = 'พร้อมขายทันที';
        } elseif($stock['cast_ready'] == '2') {
            $ready = 'รอรถใหม่จบก่อน';
        }

        if($stock['cast_car_check'] == '0'){
            $man = 'ยังไม่ตรวจ';
        } else {
            $manCheck = $db->where('user_id',$stock['cast_car_check'])->getOne('user');
            $man = $manCheck['user_nickname'];
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
            'sales' =>  $salesData,
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
            'type' => $typeOfCar,
            'seat' => $seatOfCar,
            'door' => $doorOfCar,
            'fuel' => $fuel,
            'engine' => number_format($stock['cast_engine']),
            'passengerType' => $stock['cast_passengerType'],
            'suspension' => $stock['cast_suspension'],
            'drive' => $stock['cast_drive'],
            'seller_name' => $stock['cast_seller_name'],
            'share_link' => 'https://trade-in.toyotaparagon.com/stock/'.base64_encode($stock['cast_id']),
            'publicLink' => $stock['cast_link_public'],
            'pv' => $stock['cast_pv'],
            'fin' => $fin,
            'loan' => $stock['cast_loan'],
            'ready' => $ready,
            'car_check' => $man,
        );

        $offer = $db->where('off_parent',$id)->get('offer');

        foreach ($offer as $o) {
            $partner = $db->where('part_id',$o['off_vender'])->getOne('partner');
            if(!empty($partner)){
                $pt_name = $partner['part_fname'].' - '.$partner['part_bus_name'];
                $pt_tel = $partner['part_tel'];
            } else {
                $pt_name = $o['off_vender'];
                $pt_tel = '';
            }

            $newDate = date("d M y, H:i", strtotime($o['off_datetime']));
            
            $api['offer'][] = array(
                'price' => number_format($o['off_price']),
                'partner' => $pt_name,
                'tel' => $pt_tel,
                'datetime' => $newDate
            );
        }

       

        $pros_cust = $db->where('cust_parent',$stock['cast_id'])->get('customer_data');

        foreach ($pros_cust as $value) {
            $api['pros_cust'][] = array(
                'id' => $value['cust_id'],
                'name' => $value['cust_name'],
                'tel' => $value['cust_tel'],
                'detail' => $value['cust_detail'],
                'line' => $value['cust_line'],
                'status' => $value['cust_status'],
                'datetime' => DateThai($value['cust_datetime'])
            );
        }


        $db->join('partner_bus pb', "pb.busi_id=p.part_bus_id", "RIGHT");
        $partner = $db->where('part_group',2)->where('part_status',1)->get('partner p');

        $api['partner_data'][] = array(
            'id' => 0,
            'name' => 'โปรดเลือกพันธมิตร',
        );

        foreach ($partner as $key => $value) {
            $api['partner_data'][] = array(
                'id' => $value['part_id'],
                'name' => $value['part_fname'].' - '.$value['busi_name'],
            );
        }
        

    }

    echo json_encode($api);