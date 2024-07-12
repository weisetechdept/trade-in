<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
/*
    if($_SESSION['tin_admin'] != true){
        $api = array('status' => 'error', 'message' => 'Permission denied');
    } else {
*/
        $id = $_GET['id'];
        $db->join('partner_bus b','p.part_bus_id=b.busi_id','LEFT');
        $db->join('partner_group g','p.part_group=g.pagp_id','LEFT');
        $member = $db->where('part_id',$id)->getOne('partner p');

    
        $api['detail'] = array(
            'id' => $member['part_id'],
            'profile_img' => $member['part_line_img'],
            'name' => $member['part_fname'].' '.$member['part_lname'],
            'fname' => $member['part_fname'],
            'lname' => $member['part_lname'],
            'busi_name' => $member['part_bus_name'],
            'busi_db_name' => $member['busi_name'],
            'tel' => $member['part_tel'],
            'busi_match' => $member['part_bus_id'],
            'group' => $member['part_group'],
            'group_name' => $member['pagp_name'],
            'status' => $member['part_status'],
            'create_date' => date('d/m/Y H:i:s', strtotime($member['part_datetime']))
        );

        $part_gp = $db->where('pagp_status',1)->get('partner_group');
        foreach($part_gp as $gp){
            $api['partner_gp'][] = array(
                'id' => $gp['pagp_id'],
                'name' => $gp['pagp_name']
            );
        }

        $busi_gp = $db->where('busi_status',1)->get('partner_bus');
        foreach($busi_gp as $gp){
            $api['partner_busi'][] = array(
                'id' => $gp['busi_id'],
                'name' => $gp['busi_name']
            );
        }
        $db->join('car_image i','o.off_parent=i.cari_parent','LEFT');
        $offered = $db->where('off_vender',$id)->get('offer o',5);
        foreach($offered as $offer){
            $api['offered'][] = array(
                'id' => $offer['off_id'],
                'vender' => $offer['off_vender'],
                'price' => number_format($offer['off_price']),
                'datetime' => date('d/m/Y H:i:s', strtotime($offer['off_datetime'])),
                'img' => $offer['cari_link']
            );
        }
        
/*
    }
*/
    echo json_encode($api);

    