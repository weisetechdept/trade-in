<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");
        
        if($_SESSION['tin_admin'] != true || $_SESSION['tin_login'] != true){
            echo json_encode(array('status' => '404', 'message' => 'Permission Denied'));
        } else {

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
       
            $option = $request->option;
            $vin = $request->vin;
            $mileage = $request->mileage;
            $for_serie = $request->for_serie;
            $for_change = $request->for_change;
            $for_section = $request->for_section;
            $condition = $request->condition;
            $trade_price = $request->trade_price;
            $vat = $request->vat;
            $pv = $request->pv;
            $fin = $request->fin;
            $loan = $request->loan;
            $ready = $request->ready;
    
            $change = array();
            if($for_change != '0'){
                $change = array('cast_car' => $for_section);
            }
    
            $orifinal = Array (
                'cast_transmission' => $transmission,
                'cast_color' => $color,
                'cast_mileage' => $mileage,
                'cast_license'=> $license,
                'cast_price' => $price,
                'cast_vin' => $vin,
                'cast_year' => $reg_year,
                'cast_pv' => $pv,
                'cast_fin' => $fin,
                'cast_loan' => $loan,
                'cast_ready' => $ready
    
            );
            $data = array_merge($orifinal,$change);
    
            $db->where ('cast_id', $id);
            if ($db->update ('car_stock', $data)){
    
                echo json_encode(array('status' => '200'));
            } else {
                echo json_encode(array('status' => '505'));
            }

        }
        

       
           