<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $start = $_GET['start'];
    $end = $_GET['end'];

    /* report */
    $url = "https://qms-toyotaparagon.com/api/cusbookingpayment";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = '
    {
        "date_from":"'.$start.'",
        "date_to":"'.$end.'"
    }';
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($curl);
    curl_close($curl);

    $results = json_decode($resp);
    
    //print_r($results);

    /*
    Array ( [0] => stdClass Object ( [customername] => นาย กิตติศักดิ์ กองสันเทียะ [mobilephone] => 0982561833 [price] => 557000 
    [model] => B-CAB 4x2 2.4 Entry cab&chassis Audioless [color] => 040 S.White [sale] => Jaruwan_T [manager] => G 
    [receiptdate] => 2024-01-04T00:00:00.000Z [advancepay] => 5000 [downpayment] => 181400 [cartype] => GUN122R-BTFLXT3/4A 
    [jobstatus] => Sold [reservation_no] => 101661220/010 [input01] => ซื้อรถคันแรก ) 
  
    foreach ($results as $value) {
        //echo $value->input01 . "<br>";

        if ($value->input01 == "ซื้อรถคันแรก") {
            $a += 1;
        } elseif($value->input01 == "ซื้อรถเพิ่มเติม"){
            $b += 1;
        } elseif($value->input01 == "ซื้อรถเพื่อทดแทน"){ 
            $c += 1;
        }
    }

    echo "ซื้อรถคันแรก = " . $a . "<br>";
    echo "ซื้อรถเพิ่มเติม = " . $b . "<br>";
    echo "ซื้อรถเพื่อทดแทน = " . $c . "<br>";
*/

    // Count by manager
    $managers = array();
    foreach ($results as $value) {
        $manager = $value->manager;
        if (!isset($managers[$manager])) {
            $managers[$manager] = 0;
        }
        $managers[$manager]++;
        
    }

    //print_r($managers);

    foreach ($managers as $manager => $count) {

        $trade = $db->where('cast_sales_team', $manager)
                    ->where('cast_datetime', array($start, $end), 'BETWEEN')
                    ->getValue('car_stock', 'count(*)');

        $per = number_format(($trade / $count) * 100).'%';

        $api['count'][] = array('team' => $manager, 'value' => $count,'trade' => $trade,'percentage' => $per);
        $all += $count;
        $trade_all += $trade;
    }

    $api['count'][] = array('team' => 'All', 'value' => $all,'trade' => $trade_all,'percentage' => number_format(($trade_all / $all) * 100).'%');

    //sort($api['count']);

    echo json_encode($api);
