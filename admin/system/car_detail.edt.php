<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");
        
        if($_SESSION['tin_admin'] != true){
            header("location: /404");
            exit();
        }

        $request = json_decode(file_get_contents('php://input'));

        $id = $request->id;
        $license = $request->license;
        $brand = $request->brand;
        $serie = $request->serie;
        $section = $request->section;
        $transmission = $request->transmission;
        $color = $request->color;
        $price = $request->price;
        $sales = $request->sales;
        $sales_team = $request->sales_team;
        $status = $request->status;
        $car_year = $request->car_year;
        $reg_year = $request->reg_year;
        $transmission = $request->transmission;
        $option = $request->option;
        $vin = $request->vin;
        $mileage = $request->mileage;
        $for_serie = $request->for_serie;
        $for_change = $request->for_change;
        $for_section = $request->for_section;
        $condition = $request->condition;
        $trade_price = $request->trade_price;
        $vat = $request->vat;

        $change = array();
        if($for_change != '0'){
            $change = array('cast_car' => $for_section);
        }

        $orifinal = Array (
            'cast_option' => $option,
            'cast_transmission' => $transmission,
            'cast_color' => $color,
            'cast_mileage' => $mileage,
            'cast_license'=> $license,
            'cast_price' => $price,
            'cast_trade_price' => $trade_price,
            'cast_vin' => $vin,
            'cast_year' => $reg_year,
            'cast_condition' => $condition,
            'cast_status' => $status,
            'cast_sales_parent' => $sales,
            'cast_sales_team' => $sales_team,
            'cast_vat' => $vat,

        );
        $data = array_merge($orifinal,$change);

        $db->where ('cast_id', $id);
        if ($db->update ('car_stock', $data)){

            echo json_encode(array('status' => '200'));
        } else {
            echo json_encode(array('status' => '505'));
        }
            //echo $db->count . ' records were updated';
        //else
            //echo 'update failed: ' . $db->getLastError();




//$api['detail'] = array($id,$license,$brand,$serie,$section,$transmission,$color,$price,$sales,$status,$car_year,$reg_year,$transmission,$option,$vin,$mileage,$for_section,$for_change);
//print_r(json_encode($api));