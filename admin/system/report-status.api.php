<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $get = $_GET['get'];

    if($get == 'info') {

        $monthList = array();

        for($i = 0; $i < 6; $i++) {
            $month = date('Y-m', strtotime('-'.$i.' month'));
            $monthName = date('F Y', strtotime($month));
            $monthList[] = array(
                'month' => $month,
                'monthName' => $monthName
            );
        }

        $api['monthList'] = $monthList;

    }

    if($get == 'search') {
        $get_day = isset($_GET['month_year']) ? $_GET['month_year'] : date('Y-m');
        $dayStart = date('Y-m-01 00:00:00', strtotime($get_day));
        $dayEnd = date('Y-m-t 23:59:59', strtotime($get_day));

        $status_1 = 0;
        $status_2 = 0;
        $status_3 = 0;
        $status_4 = 0;
        
        $db->join('success s', 's.succ_parent = c.cast_id', 'INNER');
        $report = $db->where('succ_date',$dayStart,">=")->where('succ_date',$dayEnd,"<=")->get('car_stock c');

        foreach ($report as $r) {
            if ($r['succ_newcar'] == 1) {
                $status_1++;
            } else if ($r['succ_newcar'] == 2) {
                $status_2++;
            } else if ($r['succ_newcar'] == 3) {
                $status_3++;
            } else if ($r['succ_newcar'] == 4) {
                $status_4++;
            }
        }

        $api['statusReport'] = array(
            's1' => $status_1,
            's2' => $status_2,
            's3' => $status_3,
            's4' => $status_4
        );
    }

    

    echo json_encode($api);