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
        $stock = $db->getOne("finance_data f", null, "f.find_id, f.find_brand, f.find_serie, f.find_section, f.find_color, f.find_price, f.find_status, c.cast_id, c.cast_license, c.cast_color, c.cast_price, c.cast_sales_parent, c.cast_sales_team, c.cast_status,cast_seller_name,cast_link_public");

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
            'sales' =>  $salesData['first_name'].' '.$salesData['last_name'].' ทีม '.getTeam($stock['cast_sales_parent_no']),
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
            'engine' => $stock['cast_engine'],
            'passengerType' => $stock['cast_passengerType'],
            'suspension' => $stock['cast_suspension'],
            'drive' => $stock['cast_drive'],
            'seller_name' => $stock['cast_seller_name'],
            'share_link' => 'https://trade-in.toyotaparagon.com/stock/'.base64_encode($stock['cast_id']),
            'publicLink' => $stock['cast_link_public']
        );

        $offer = $db->where('off_parent',$id)->get('offer');

        foreach ($offer as $o) {
            $api['offer'][] = array(
                'price' => $o['off_price'],
                'partner' => $o['off_vender'],
                'datetime' => $o['off_datetime']
            );
        }

    }

    print_r(json_encode($api));