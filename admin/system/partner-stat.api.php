<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_GET['fetch'] == 'find'){

        $search = $_GET['search'];
        #2025-01-01

        $dataform = date('Y-m-01', strtotime($search));
        $dateto = date('Y-m-t', strtotime($search));

        $stat = $db->where('off_datetime',$dataform,">=")->where('off_datetime',$dateto,"<=")->get('offer');

        $api = array();
        $rs = array();
        $count_all = 0;

        function getPartner($id){
            global $db;
            $partner = $db->where('part_id',$id)->getOne('partner');
            if ($partner) {
                return $partner['part_fname'].' '.$partner['part_lname'];
            } else {
                return $id;
            }
        }

        foreach($stat as $value){
            if(!isset($rs[$value['off_vender']])) $rs[$value['off_vender']] = 0;
            $rs[$value['off_vender']]++;
        }

        foreach($rs as $key => $value){
            $api[] = array(
                'id' => (int) $key,
                'name' => getPartner($key),
                'count' => $value
            );
            $count_all += $value;
        }

        usort($api, function($a, $b) {
            return $b['count'] - $a['count'];
        });

        
        $api['count_all'] = $count_all;
    }


    if($_GET['fetch'] == 'date'){
        $thai_month_year = array();
        for ($i = 0; $i < 6; $i++) {
            $date = strtotime("-$i month");
            $thai_month_year[] = array(
                'month' => date('F', $date),
                'year' => date('Y', $date),
                'value' => date('Y-m-01', $date)
            );
        }
        $api['thai_month_year'] = $thai_month_year;
    }

    echo json_encode($api);