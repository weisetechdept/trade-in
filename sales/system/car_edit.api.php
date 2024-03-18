<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    
    $id = $_GET['u'];

    $chk_data = $db->where('cast_id', $id)->getOne('car_stock');
    
    if($_SESSION['tin_login'] != true || $_SESSION['tin_user_id'] != $chk_data['cast_sales_parent_no']){

        $api['status'] = '404';

    } else {

        if(!empty($id)){

            $db->join('car_stock c', "f.find_id=c.cast_car", "RIGHT");
            $db->where('c.cast_id', $id);
            $stock = $db->getOne("finance_data f", null, "f.find_id, f.find_brand, f.find_serie, f.find_section, f.find_color, f.find_price, f.find_status, c.cast_id, c.cast_license, c.cast_color, c.cast_price, c.cast_sales_parent, c.cast_sales_team, c.cast_status, c.cast_trade_price");

            $api['car'] = array('id' => $stock['cast_id'],
                'license' => $stock['cast_license'],
                'brand' => $stock['find_brand'],
                'serie' => $stock['find_serie'],
                'section' => $stock['find_section'],
                'car_year' => $stock['find_year'],
                'reg_year' => $stock['cast_year'],
                'color' => $stock['cast_color'],
                'price' => $stock['cast_price'],
                'trade_price' => $stock['cast_trade_price'],
                'tlt_price' => $stock['find_price'],
                'sales' => $stock['cast_sales_parent'],
                'sale_team' => $stock['cast_sales_team'],
                'status' => $stock['cast_status'],
                'transmission' => $stock['cast_transmission'],
                'option' => $stock['cast_option'],
                'condition' => $stock['cast_condition'],
                'vin' => $stock['cast_vin'],
                'mileage' => $stock['cast_mileage'],
                'tel' => '0'.$stock['cast_tel'],
                'vat' => $stock['cast_vat'],
            );

            $brand = $db->get('finance_data');
            foreach ($brand as $value) {
                $api['brand'][] = $value['find_brand'];

            }
            $api['brand'] = array_unique($api['brand']);

        } else {
            $api['status'] = '404';
        }
    }

    print_r(json_encode($api));