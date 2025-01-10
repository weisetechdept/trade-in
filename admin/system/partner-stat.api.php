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

        function getPartnerBus($id){
            global $db;
            $join = $db->join('partner p','p.part_bus_id = pb.busi_id','LEFT');
            $partner = $db->where('p.part_id',$id)->getOne('partner_bus pb');
            if ($partner) {
                return $partner['busi_name'];
            } elseif($id == 0) {
                return 'unknow';
            }
        }

        foreach($stat as $value){
            $check[] = $value['off_parent'];

            if(in_array($value['off_parent'], $check)) {
                if(!isset($rs[$value['off_vender']])) $rs[$value['off_vender']] = 0;
                $rs[$value['off_vender']]++;
            }
        }

        foreach($rs as $key => $value){
            $api[] = array(
                'id' => (int) $key,
                'name' => getPartner($key),
                'partbus' => getPartnerBus($key),
                'count' => $value
            );
            $count_all += $value;
        }

        usort($api, function($a, $b) {
            return strcmp($b['partbus'], $a['partbus']);
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