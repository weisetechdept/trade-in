<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");

        $request = json_decode(file_get_contents('php://input'));

        $price = $request->price;
        $for_section = $request->for_section;
        $sales = $request->sales;
        $sales_team = $request->sales_team;
        $tel = $request->tel;

        $data = array(
            'cast_car' => $for_section,
            'cast_option' => '',
            'cast_transmission' => '',
            'cast_color' => '',
            'cast_mileage' => '0',
            'cast_year'=> '0',
            'cast_license' => '',
            'cast_vin' => '',
            'cast_price' => $price,
            'cast_trade_price' => '0',
            'cast_condition' => '',
            'cast_sales_parent' => $sales,
            'cast_sales_team' => $sales_team,
            'cast_tel' => $tel,
            'cast_status' => '0', 
            'cast_datetime' => date('Y-m-d H:i:s')
        );
        $id = $db->insert('car_stock', $data);
        if ($id){
            echo json_encode(array('status' => '200','id' => $id));
        } else {
            echo json_encode(array('status' => '505'));
        }
      
   