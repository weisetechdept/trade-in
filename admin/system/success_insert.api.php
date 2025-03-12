<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $requset = json_decode(file_get_contents('php://input'));

    $id = $requset->id ?? null;
    $partner = $requset->partner ?? null;
    $price = $requset->price ?? null;
    $commission = $requset->commission ?? null;
    $newcar = $requset->newcar ?? null;
    $newcar_detail = $requset->newcar_detail ?? null;
    $date = $requset->date ?? null;
    $detail = $requset->detail ?? '';

    $chk = $db->where('succ_parent',$id)->getOne('success');
    if($chk){
        $data = array(
            'succ_partner' => $partner,
            'succ_price' => $price,
            'succ_commission' => $commission,
            'succ_newcar' => $newcar,
            'succ_newcar_detail' => $newcar_detail,
            'succ_date' => $date,
            'succ_comment' => $detail,
            'succ_update_at' => date('Y-m-d H:i:s'),
        );
        $update = $db->where('succ_parent',$id)->update('success',$data);
        if($update){
            $api['updateSucc']['status'] = 'success';
        } else {
            $api['updateSucc']['status'] = 'error' . $db->getLastError();
        }
    }else{
        $data = array(
            
            'succ_partner' => $partner,
            'succ_price' => $price,
            'succ_commission' => $commission,
            'succ_newcar' => $newcar,
            'succ_newcar_detail' => $newcar_detail,
            'succ_comment' => $detail,
            'succ_date' => $date,
            'succ_parent' => $id,
            'succ_create_at' => date('Y-m-d H:i:s'),
            'succ_update_at' => date('Y-m-d H:i:s'),

        );
        $insert = $db->insert('success',$data);
        if($insert){
            $api['updateSucc']['status'] = 'success';
        }else{
            $api['updateSucc']['status'] = 'error' . $db->getLastError();
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