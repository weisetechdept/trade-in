<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $requset = json_decode(file_get_contents('php://input'));

    $id = $requset->id;
    $partner = $requset->partner;
    $price = $requset->price;
    $commission = $requset->commission;
    $newcar = $requset->newcar;

    $chk = $db->where('succ_parent',$id)->getOne('success');
    if($chk){
        $data = array(
            'succ_partner' => $partner,
            'succ_price' => $price,
            'succ_commission' => $commission,
            'succ_newcar' => $newcar,
            'succ_update_at' => date('Y-m-d H:i:s'),
        );
        $update = $db->where('succ_parent',$id)->update('success',$data);
        if($update){
            $api['updateSucc']['status'] = 'success';
        } else {
            $api['updateSucc']['status'] = 'error';
        }
    }else{
        $data = array(
            
            'succ_partner' => $partner,
            'succ_price' => $price,
            'succ_commission' => $commission,
            'succ_newcar' => $newcar,
            'succ_parent' => $id,
            'succ_create_at' => date('Y-m-d H:i:s'),
            'succ_update_at' => date('Y-m-d H:i:s'),

        );
        $insert = $db->insert('success',$data);
        if($insert){
            $api['updateSucc']['status'] = 'success';
        }else{
            $api['updateSucc']['status'] = 'error';
        }
    }

    echo json_encode($api);
    // $data = array(
    //     'succ_parent' => $id,
    //     'succ_partner' => $partner,
    //     'succ_price' => $price,
    //     'succ_commission' => $commission,
    //     'succ_newcar' => $newcar,
    // )