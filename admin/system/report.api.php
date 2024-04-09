<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");

        if($_SESSION['tin_admin'] != true){
            header("location: /404");
            exit();
        } else {

            if($_GET['get'] == 'count'){
                $team = $db_nms->get('db_user_group');
                foreach ($team as $value) {
                    if($value['id'] != '26' && $value['id'] != '27'){
    
                        $mteam = array_merge(json_decode($value['detail']),json_decode($value['leader']));
                        
                        $st0 = $db->where('cast_sales_parent_no',$mteam,'IN')->where('cast_status',0)->getValue('car_stock','count(*)');
                        $st1 = $db->where('cast_sales_parent_no',$mteam,'IN')->where('cast_status',1)->getValue('car_stock','count(*)');
                        $st2 = $db->where('cast_sales_parent_no',$mteam,'IN')->where('cast_status',2)->getValue('car_stock','count(*)');
                        $st3 = $db->where('cast_sales_parent_no',$mteam,'IN')->where('cast_status',3)->getValue('car_stock','count(*)');
                        $st4 = $db->where('cast_sales_parent_no',$mteam,'IN')->where('cast_status',4)->getValue('car_stock','count(*)');
    
    
                        $api['data'][] = array(
                            $value['name'],
                            $st0,
                            $st1,
                            $st2,
                            $st3,
                            $st4,
                            $st0 + $st1 + $st2 + $st3 + $st4, 
                        );

                        $allst0 += $st0;
                        $allst1 += $st1;
                        $allst2 += $st2;
                        $allst3 += $st3;
                        $allst4 += $st4;
                        $allst += $st0 + $st1 + $st2 + $st3 + $st4;
    
                    }
    
                }
                $api['data'][] = array(
                    'รวม',
                    $allst0,
                    $allst1,
                    $allst2,
                    $allst3,
                    $allst4,
                    $allst,
                );
    
            } elseif($_GET['get'] == 'search'){
                $start = $_GET['start'].' 00:00:00';
                $end = $_GET['end'].' 23:59:59';
    
                $team = $db_nms->get('db_user_group');
    
                foreach ($team as $value) {
                    if($value['id'] != '26' && $value['id'] != '27'){
    
                        $mteam = array_merge(json_decode($value['detail']),json_decode($value['leader']));
                        
                        $st0 = $db->where('cast_datetime', array($start, $end), 'BETWEEN')->where('cast_sales_parent_no',$mteam,'IN')->where('cast_status',0)->getValue('car_stock','count(*)');
                        $st1 = $db->where('cast_datetime', array($start, $end), 'BETWEEN')->where('cast_sales_parent_no',$mteam,'IN')->where('cast_status',1)->getValue('car_stock','count(*)');
                        $st2 = $db->where('cast_datetime', array($start, $end), 'BETWEEN')->where('cast_sales_parent_no',$mteam,'IN')->where('cast_status',2)->getValue('car_stock','count(*)');
                        $st3 = $db->where('cast_datetime', array($start, $end), 'BETWEEN')->where('cast_sales_parent_no',$mteam,'IN')->where('cast_status',3)->getValue('car_stock','count(*)');
                        $st4 = $db->where('cast_datetime', array($start, $end), 'BETWEEN')->where('cast_sales_parent_no',$mteam,'IN')->where('cast_status',4)->getValue('car_stock','count(*)');
    
    
                        $api['data'][] = array(
                            $value['name'],
                            $st0,
                            $st1,
                            $st2,
                            $st3,
                            $st4,
                            $st0 + $st1 + $st2 + $st3 + $st4, 
                        );

                        $allst0 += $st0;
                        $allst1 += $st1;
                        $allst2 += $st2;
                        $allst3 += $st3;
                        $allst4 += $st4;
                        $allst += $st0 + $st1 + $st2 + $st3 + $st4;
    
                    }
    
                }
                $api['data'][] = array(
                    'รวม',
                    $allst0,
                    $allst1,
                    $allst2,
                    $allst3,
                    $allst4,
                    $allst,
                );
            }
            echo json_encode($api);

        }

        
        