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
    */

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

    $api['type'] = array(
        'first' => $a,
        'addon' => $b,
        'replace' => $c,
        'all' => $a + $b + $c,
        'first_per' => number_format(($a / ($a + $b + $c)) * 100,2,".","").'%',
        'addon_per' => number_format(($b / ($a + $b + $c)) * 100,2,".","").'%',
        'replace_per' => number_format(($c / ($a + $b + $c)) * 100,2,".","").'%',

    );

    // Count by manager
    $managers = array();
    foreach ($results as $value) {
        $manager = $value->manager;

        if (!isset($managers[$manager])) {
            $managers[$manager] = 0;
        }
        
        $managers[$manager]++;

        if($value->input01 == "ซื้อรถคันแรก"){
            $objBuy[$manager]['first'] += 1;
        } elseif($value->input01 == "ซื้อรถเพิ่มเติม"){
            $objBuy[$manager]['addon'] += 1;
        } elseif($value->input01 == "ซื้อรถเพื่อทดแทน"){
            $objBuy[$manager]['replace'] += 1;
        }
        
    }

    foreach ($managers as $manager => $count) {

        $wait = $db->where('cast_sales_team', $manager)
                    ->where('cast_datetime', array($start, $end), 'BETWEEN')
                    ->where('cast_status', array(0,1,2),'IN')
                    ->getValue('car_stock', 'count(*)');

        $trade = $db->where('cast_sales_team', $manager)
                    ->where('cast_datetime', array($start, $end), 'BETWEEN')
                    ->where('cast_status', array(1,2,3,4),'IN')
                    ->getValue('car_stock', 'count(*)');
        
        $per = number_format(($trade / $count) * 100).'%';

        $api['count'][] = array(
            'team' => $manager,
            'value' => $count,
            'trade' => $trade,
            'percentage' => $per,
            'objFirst' => empty($objBuy[$manager]['first']) ? 0 : $objBuy[$manager]['first'],
            'objAddon' => empty($objBuy[$manager]['addon']) ? 0 : $objBuy[$manager]['addon'],
            'objReplace' => empty($objBuy[$manager]['replace']) ? 0 : $objBuy[$manager]['replace'],
            'wait_value' => $wait
        );

        $all += $count;
        $trade_all += $trade;
        $first_all += $objBuy[$manager]['first'];
        $addon_all += $objBuy[$manager]['addon'];
        $replace_all += $objBuy[$manager]['replace'];
        $wait_all += $wait;
    }

    $api['count'][] = array('team' => 'All',
                            'value' => $all,
                            'trade' => $trade_all,
                            'percentage' => number_format(($trade_all / $all) * 100).'%',
                            'objFirst' => $first_all,
                            'objAddon' => $addon_all,
                            'objReplace' => $replace_all,
                            'wait_value' => $wait_all
                        );

    echo json_encode($api);
