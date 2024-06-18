<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $id = base64_decode($_GET['id']);

    if($id){

            $db->join('car_stock c', "f.find_id=c.cast_car", "RIGHT");
            $db->where('c.cast_id', $id);
            $stock = $db->getOne("finance_data f", null, "f.find_id, f.find_brand, f.find_serie, f.find_section, f.find_color, f.find_price, f.find_status, c.cast_id, c.cast_license, c.cast_color, c.cast_price, c.cast_sales_parent, c.cast_sales_team, c.cast_status,cast_seller_name,cast_link_public");

            if($stock['cast_link_public'] == '1'){

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
    
                if($stock['cast_drive'] == '1'){
                    $driveOfCar = 'ขับเคลื่อน 2 ล้อ';
                } elseif($stock['cast_drive'] == '2'){
                    $driveOfCar = 'ขับเคลื่อน 4 ล้อ';
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

                if(number_format($stock['cast_mileage']) == '0'){
                    $mileage = 'ไม่มีข้อมูล';
                } else {
                    $mileage = number_format($stock['cast_mileage']);
                }

                if($stock['cast_fin'] == '1'){
                    $fin = 'ติดไฟแนนซ์ - '. number_format($stock['cast_loan']).' บาท';
                } else {
                    $fin = 'ปลอดภาระ';
                }
        
                if($stock['cast_ready'] == '1'){
                    $ready = 'พร้อมขายทันที';
                } else {
                    $ready = 'รอรถใหม่จบก่อน';
                }
    
    
                $api['detail'] = array('id' => $stock['cast_id'],
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
                    'mileage' => $mileage,
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
                    'drive' => $driveOfCar,
                    'seller_name' => $stock['cast_seller_name'],
                    'link' => 'https://trade-in.toyotaparagon.com/stock/'.base64_encode($stock['cast_id']),
                    'share' => $stock['cast_link_public'],
                    'pv' => $stock['cast_pv'],
                    'fin' => $fin,
                    'loan' => $stock['cast_loan'],
                    'ready' => $ready
                );

                $db->join('car_image i','c.cast_id = i.cari_parent','LEFT');
                $car = $db->where('cast_id',$id)->get('car_stock c');

                if($car){
                    foreach ($car as $value) {
                        $api['img'][] = $value['cari_link'];
                    }
                } else {
                    $api['img'] = array('code' => '404','message' => 'Not Found');
                }

            } else {
                $api['detail'] = array('code' => '404','message' => 'Not Found','share' => $stock['cast_link_public']);
            }

            

    } else {
        $api['detail'] = array('code' => '404','message' => 'Not Found');
    }
    
    echo json_encode($api);
    