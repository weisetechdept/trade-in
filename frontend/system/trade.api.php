<?php 
session_start();
require_once '../../db-conn.php';
date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));

    $name = $request->name;
    $license = $request->license;
    $tel = $request->tel;
    $photo1 = $request->photo1;
    $photo2 = $request->photo2;
    $photo3 = $request->photo3;
    $photo4 = $request->photo4;
    $photo5 = $request->photo5;
    $photo6 = $request->photo6;
    $photo7 = $request->photo7;
    $photo8 = $request->photo8;
    $photo9 = $request->photo9;

    $data = array(
        'cast_car' => '',
        'cast_option' => '',
        'cast_transmission' => '',
        'cast_color' => '',
        'cast_mileage' => '0',
        'cast_year'=> '0',
        'cast_license' => $license,
        'cast_vin' => '',
        'cast_price' => '0',
        'cast_trade_price' => '0',
        'cast_condition' => '',
        'cast_sales_parent' => 'Online',
        'cast_sales_parent_no' => '0',
        'cast_sales_team' => 'NoSales',
        'cast_seller_name' => $name,
        'cast_tel' => $tel,
        'cast_vat' => '0',
        'cast_status' => '0', 
        'cast_datetime' => date('Y-m-d H:i:s')
    );

    $id = $db->insert('car_stock', $data);
    
    if ($id){
    
        echo json_encode(array('status' => '200','id' => $id));


        if($photo1 != ''){
            $image = $_FILES['file_upload']['tmp_name'];
            $type = mime_content_type($photo1);
            $name = basename($photo1);
    
            $url = 'https://api.cloudflare.com/client/v4/accounts/1adf66719c0e0ef72e53038acebcc018/images/v1';
            $cfile = curl_file_create($image, $type, $name);
            $data = array("file" => $cfile);
            
            $headers = [ 
                'Authorization: Bearer x2skj57v2poPW8UxIQGqBACBxkJ4Glg42lVhbDPe',
                'Content-Type: multipart/form-data'
            ];
            
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
            
            print_r($response);
        }



    } else {
        echo json_encode(array('status' => '505'));
    }
