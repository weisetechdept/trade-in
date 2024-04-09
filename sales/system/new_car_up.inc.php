<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");
        /*
        if($_SESSION['tin_admin'] != true){
            header("location: /404");
            exit();
        }
        */

        $request = json_decode(file_get_contents('php://input'));

        $type = $request->type;
        $seat = $request->seat; 
        $door = $request->door;
        $transmission = $request->transmission;
        $fuel = json_encode($request->fuel);
        $engine = $request->engine;
        $price = $request->price;
        $seller_name = $request->seller_name; 
        $tel = $request->tel;
        $passengerType = $request->passengerType; 
        $suspension = $request->suspension; 
        $drive = $request->drive; 
        $year = $request->year;

        $user_id = $_SESSION['tin_user_id'];
        $usr = $db_nms->where('id', $user_id)->getOne('db_member');

        $data = array(
            'cast_car' => '',
            'cast_option' => '',
            'cast_transmission' => $transmission,
            'cast_color' => '',
            'cast_mileage' => '0',
            'cast_year'=> $year,
            'cast_license' => '',
            'cast_vin' => '',
            'cast_price' => $price,
            'cast_trade_price' => '0',
            'cast_condition' => '',
            'cast_sales_parent' => $usr['nickname'],
            'cast_sales_parent_no' => $user_id,
            'cast_sales_team' => '',
            'cast_seller_name' => $seller_name,
            'cast_tel' => $tel,
            'cast_vat' => '0',

            'cast_type' => $type,
            'cast_seat' => $seat,
            'cast_door' => $door,
            'cast_fuel' => $fuel,
            'cast_engine' => $engine,
            'cast_passengerType' => $passengerType,
            'cast_suspension' => $suspension,
            'cast_drive' => $drive,
            'cast_link_public' => '0',
            'cast_thumb' => '0',
            'cast_status' => '0', 
            'cast_datetime' => date('Y-m-d H:i:s')
        );

        $id = $db->insert('car_stock', $data);
        if ($id){
            echo json_encode(array('status' => '200','id' => $id));
        } else {
            echo json_encode(array('status' => '505', 'error' => $db->getLastError()));
        }

        /*

        $data = array(
            'cast_car' => '',
            'cast_option' => '',
            'cast_transmission' => $transmission,
            'cast_color' => '',
            'cast_mileage' => '0',
            'cast_year'=> $year,
            'cast_license' => '',
            'cast_vin' => '',
            'cast_price' => $price,
            'cast_trade_price' => '0',
            'cast_condition' => '',
            'cast_sales_parent' => $usr['nickname'],
            'cast_sales_parent_no' => $user_id,
            'cast_sales_team' => '',
            'cast_seller_name' => $seller_name,
            'cast_tel' => $tel,
            'cast_vat' => '0',
            'cast_type' => $type,
            'cast_seat' => $seat,
            'cast_door' => $door,
            'cast_fuel' => $fuel,
            'cast_engine' => $engine,
            'cast_passengerType' => $passengerType,
            'cast_suspension' => $suspension,
            'cast_drive' => $drive,
            'cast_status' => '0', 
            'cast_datetime' => date('Y-m-d H:i:s')
        );

        */

   