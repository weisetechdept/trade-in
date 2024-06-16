<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");

        $car = $_GET['u'];

        for($i=10;$i<23;$i++){
            $chk = $db->where('cari_parent',$car)->where('cari_group',$i)->where('cari_status',1)->getValue('car_image','count(*)');
            $api['count'][$i] = $chk;
        }

        if($api['count'][10] <= 0 || $api['count'][11] <= 0 || $api['count'][12] <= 0 || $api['count'][13] <= 0 || $api['count'][14] <= 0 || $api['count'][15] <= 0 || $api['count'][16] <= 0 || $api['count'][17] <= 0 || $api['count'][18] <= 0 || $api['count'][19] <= 0 || $api['count'][20] <= 0 || $api['count'][21] <= 0){
            $api['status'] = '0';
        } else {
            $api['status'] = '1';
        }

        echo json_encode($api);