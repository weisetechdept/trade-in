
<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");

        if($_GET['get'] == 'search') {

            $allst0 = 0;
            $allst1 = 0;
            $allst2 = 0;
            $allst3 = 0;
            $allst4 = 0;
            $allst = 0;

            $start = $_GET['start'].' 00:00:00';
            $end = $_GET['end'].' 23:59:59';

            $api['data'] = array();

            $nameTeam = array(
                'A',
                'B',
                'C',
                'D',
                'G',
                'I',
                'X',
                'E',
                'H',
                'J',
                'K',
                'L',
                'M',
                'R',
                'W',
                'N',
                'T',
                'V',
                'U',
                'P',
                'Z',
                'S'
            );

            $team = $db_nms->where('name',$nameTeam,'IN')->get('db_user_group');
            foreach ($team as $value) {

                $man = array_merge(json_decode($value['detail']), json_decode($value['leader']));
                $man = array_unique($man);

                //echo json_encode($man).' <br />';

                $st0 = $db->where('cast_sales_parent_no',$man,'IN')->where('cast_datetime', array($start, $end), 'BETWEEN')->where('cast_status', 0)->getValue('car_stock','count(*)');
                $st1 = $db->where('cast_sales_parent_no',$man,'IN')->where('cast_datetime', array($start, $end), 'BETWEEN')->where('cast_status', 1)->getValue('car_stock','count(*)');
                $st2 = $db->where('cast_sales_parent_no',$man,'IN')->where('cast_datetime', array($start, $end), 'BETWEEN')->where('cast_status', 2)->getValue('car_stock','count(*)');
                $st3 = $db->where('cast_sales_parent_no',$man,'IN')->where('cast_datetime', array($start, $end), 'BETWEEN')->where('cast_status', 3)->getValue('car_stock','count(*)');
                $st4 = $db->where('cast_sales_parent_no',$man,'IN')->where('cast_datetime', array($start, $end), 'BETWEEN')->where('cast_status', 4)->getValue('car_stock','count(*)');

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

            $api['data'][] = array(
                'รวม',
                $allst0,
                $allst1,
                $allst2,
                $allst3,
                $allst4,
                $allst,
            );

            echo json_encode($api);

        }

            


        
        