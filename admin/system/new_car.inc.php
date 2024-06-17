<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");
        
        if($_SESSION['tin_admin'] != true){
            header("location: /404");
            exit();
        }

        $request = json_decode(file_get_contents('php://input'));

        $price = $request->price;
        $for_section = $request->for_section;
        $sales = $request->sales;
        $sales_team = $request->sales_team;
        $tel = $request->tel;

        if($price == '' || $for_section == '' || $sales == '' || $sales_team == '' || $tel == ''){
            
            $api = array('status' => '400');

        } else {

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
                'cast_sales_parent_no' => '',
                'cast_sales_team' => $sales_team,
                'cast_seller_name' => '',
                'cast_tel' => $tel,
                'cast_vat' => '0',
    
                'cast_type' => '',
                'cast_seat' => '',
                'cast_door' => '',
                'cast_fuel' => '',
                'cast_engine' => '',
                'cast_passengerType' => '',
                'cast_suspension' => '',
                'cast_drive' => '',
                'cast_link_public' => '0',
                'cast_thumb' => '0',

                'cast_pv' => '',
                'cast_fin' => '',
                'cast_loan' => '',
                'cast_ready' => '',
    
                'cast_status' => '0', 
                'cast_datetime' => date('Y-m-d H:i:s') 
            );
            $id = $db->insert('car_stock', $data);
            if ($id){
                $api = array('status' => '200','id' => $id);
            } else {
                $api = array('status' => '505');
            }

        }

        echo json_encode($api);

        
      
   