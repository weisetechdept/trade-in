<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    // $start = '2025-07-01';
    // $end = '2025-07-11';

    $focus_month_year = '2025-07';
    $focus_back = 3;

    function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate));
		$strMonth= date("n",strtotime($strDate));
        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strMonthThai $strYear";
	}

    $team = array('A','B','C','D','G','I','P','U','X','Z');

   

    for($i = 0; $i < $focus_back; $i++) {

        $month = date('m', strtotime($focus_month_year . '-01'));
        $year = date('Y', strtotime($focus_month_year . '-01'));
        $target_month = $month - $i;
        $target_year = $year;
        while ($target_month <= 0) {
            $target_month += 12;
            $target_year--;
        }

        $current_focus_month_year = sprintf('%04d-%02d', $target_year, $target_month);

        $start = $current_focus_month_year . '-01';
        $end = date('Y-m-t', strtotime($start));

            $url = $booking_payment_api;
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
 
            // Initialize managerCounts for this month
            $managerCounts = [];

            foreach ($results as $result) {
                $manager = $result->manager;
                if (!isset($managerCounts[$manager])) {
                    $managerCounts[$manager] = [
                        'bkn' => 0,
                        'canceln' => 0,
                        'trade_in' => 0,
                        'trade_in_per' => 0,
                        'check' => 0,
                        'check_per' => 0,
                        'touch' => 0,
                        'touch_per' => 0,
                        'trade_bo_rs' => 0,
                        'trade_n_rs' => 0,
                        'no_touch' => 0,
                        'no_touch_per' => 0,
                        'month_year' => DateThai(date('Y-m', strtotime($focus_month_year . '-01 -' . $i . ' month')))
                    ];
                }

                if ($result->advancepay > 0) {
                    if (
                        isset($result->advancepay, $result->jobstatus, $result->manager) &&
                        strtolower($result->jobstatus) !== 'follow up'
                    ) {
                        $managerCounts[$manager]['bkn']++;
                    } else {
                        $managerCounts[$manager]['canceln']++;
                    }
                }
                
               
                
            }

            // Fill reportData for each team
            foreach ($team as $t) {
                

                if (isset($managerCounts[$t])) {
                    $reportData['team'][$t][] = $managerCounts[$t];
                } else {
                    $reportData['team'][$t][] = [
                        'bkn' => 0,
                        'canceln' => 0,
                        'trade_in' => 0,
                        'trade_in_per' => 0,
                        'check' => 0,
                        'check_per' => 0,
                        'touch' => 0,
                        'touch_per' => 0,
                        'trade_bo_rs' => 0,
                        'trade_n_rs' => 0,
                        'no_touch' => 0,
                        'no_touch_per' => $start.' - ' . $end,
                        'month_year' => DateThai(date('Y-m', strtotime($focus_month_year . '-01 -' . $i . ' month')))
                    ];
                }
            }

            $reportData['count']['total'] = [
                'bkn' => array_sum(array_column($managerCounts, 'bkn')),
                'canceln' => array_sum(array_column($managerCounts, 'canceln')),
                'trade_in' => array_sum(array_column($managerCounts, 'trade_in')),
                'trade_in_per' => 0, // Placeholder for future calculation
                'check' => array_sum(array_column($managerCounts, 'check')),
                'check_per' => 0, // Placeholder for future calculation
                'touch' => array_sum(array_column($managerCounts, 'touch')),
                'touch_per' => 0, // Placeholder for future calculation
                'trade_bo_rs' => array_sum(array_column($managerCounts, 'trade_bo_rs')),
                'trade_n_rs' => array_sum(array_column($managerCounts, 'trade_n_rs')),
                'no_touch' => array_sum(array_column($managerCounts, 'no_touch')),
                'no_touch_per' => $start.' - ' . $end
            ];
        
    }

    //$trade_in = $db->where('cast_datetime', $start, '>=')->getValue('car_stock', 'count(*)');
    //$managerCounts['team']['A'][0]['trade_in'] = $trade_in;

    echo json_encode($reportData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
    

    // foreach ($team as $t) {

    //     for($i = 0; $i < $focus_back; $i++) {

    //         $month = date('m', strtotime($focus_month_year . '-01'));
    //         $year = date('Y', strtotime($focus_month_year . '-01'));
    //         $target_month = $month - $i;
    //         $target_year = $year;
    //         while ($target_month <= 0) {
    //             $target_month += 12;
    //             $target_year--;
    //         }

    //         $current_focus_month_year = sprintf('%04d-%02d', $target_year, $target_month);

    //         $start = $current_focus_month_year . '-01';
    //         $end = date('Y-m-t', strtotime($start));

    
      
    //         $reportData['team'][$t][] = array(
    //             'bkn' => 0,
    //             'canceln' => 0,
    //             'trade_in' => 0,
    //             'trade_in_per' => 0,
    //             'check' => 0,
    //             'check_per' => 0,
    //             'touch' => 0,
    //             'touch_per' => 0,
    //             'trade_bo_rs' => 0,
    //             'trade_n_rs' => 0,
    //             'no_touch' => 0,
    //             'no_touch_per' => $start.' - ' . $end,
    //             'month_year' => DateThai(date('Y-m', strtotime($focus_month_year . '-01 -' . $i . ' month')))
    //         );
    //     }

    // }

    // echo json_encode($reportData['team'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


    // $api = array();

    // for ($i = 0; $i < $focus_back; $i++) {
        
    //     $month = date('m', strtotime($focus_month_year . '-01'));
    //     $year = date('Y', strtotime($focus_month_year . '-01'));
    //     $target_month = $month - $i;
    //     $target_year = $year;
    //     while ($target_month <= 0) {
    //         $target_month += 12;
    //         $target_year--;
    //     }

    //     $current_focus_month_year = sprintf('%04d-%02d', $target_year, $target_month);

    //     $start = $current_focus_month_year . '-01';
    //     $end = date('Y-m-t', strtotime($start));


    //         $url = $booking_payment_api;
    //         $curl = curl_init($url);
    //         curl_setopt($curl, CURLOPT_URL, $url);
    //         curl_setopt($curl, CURLOPT_POST, true);
    //         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //         $headers = array(
    //             "Accept: application/json",
    //             "Content-Type: application/json",
    //         );
    //         curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    //         $data = '
    //         {
    //             "date_from":"'.$start.'",
    //             "date_to":"'.$end.'"
    //         }';
    //         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    //         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    //         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    //         $resp = curl_exec($curl);
    //         curl_close($curl);

    //         $results = json_decode($resp);
    //         //print_r($results);

    //         $managerCounts = [];

    //         foreach ($results as $result) {

    //             $manager = $result->manager;
    //             if (!isset($managerCounts[$manager])) {
    //                 $managerCounts[$manager] = ['bkn' => 0, 'canceln' => 0];
    //             }

    //             if($result->advancepay > 0){
    //                 if (
    //                     isset($result->advancepay, $result->jobstatus, $result->manager) &&
    //                     strtolower($result->jobstatus) !== 'follow up'
    //                 ) {
    //                     $managerCounts[$manager]['bkn']++;
    //                 } else {
    //                     $managerCounts[$manager]['canceln']++;
    //                 }
    //             }

    //             $managerCounts[$manager]['trade_in'] = 0;
    //             $managerCounts[$manager]['trade_in_per'] = 0;
    //             $managerCounts[$manager]['check'] = 0;
    //             $managerCounts[$manager]['check_per'] = 0;
    //             $managerCounts[$manager]['touch'] = 0;
    //             $managerCounts[$manager]['touch_per'] = 0;
    //             $managerCounts[$manager]['trade_bo_rs'] = 0;
    //             $managerCounts[$manager]['trade_n_rs'] = 0;
    //             $managerCounts[$manager]['no_touch'] = 0;
    //             $managerCounts[$manager]['no_touch_per'] = 0;
                
    //         }

    //         ksort($managerCounts);
    //         $api[] = $managerCounts;

        

    // }

    //echo json_encode($api, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


    

   
    