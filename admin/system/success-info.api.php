<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $db->join('partner_bus b', "p.part_bus_id=b.busi_id", "LEFT");
    $db->groupBy('p.part_id');
    $partner = $db->where('part_group',2)->where('part_status',1)->get('partner p');

    foreach($partner as $value){
        $api['data'][] = array(
            'id' => $value['part_id'],
            'name' => $value['busi_name'].' - '.$value['part_fname'].' '. $value['part_lname']
        );
    }

    $api['jobData'] = array();

    $api['jobData'] = array(
        'id' => $_GET['id'],
        'partner' => 0,
        'price' => '',
        'commission' => '',
        'newcar' => 0,
        'date' => '0000-00-00'
    );


    $chk = $db->where('succ_parent',$_GET['id'])->getOne('success');

    if($chk){
        $api['jobData'] = array(
            'id' => $chk['succ_parent'],
            'partner' => $chk['succ_partner'],
            'price' => $chk['succ_price'],
            'commission' => $chk['succ_commission'],
            'newcar' => $chk['succ_newcar'],
            'date' => $chk['succ_date']
        );
    }

    echo json_encode($api);