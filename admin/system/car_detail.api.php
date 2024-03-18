<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }

    $id = $_GET['u'];

    if(!empty($id)){

        $db->join('car_stock c', "f.find_id=c.cast_car", "RIGHT");
        $db->where('c.cast_id', $id);
        $stock = $db->getOne("finance_data f", null, "f.find_id, f.find_brand, f.find_serie, f.find_section, f.find_color, f.find_price, f.find_status, c.cast_id, c.cast_license, c.cast_color, c.cast_price, c.cast_sales_parent, c.cast_sales_team, c.cast_status");

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
        );

    }

    print_r(json_encode($api));